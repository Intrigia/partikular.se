<?php
/**
 * Matomo - free/libre analytics platform
 *
 * @link https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */

namespace Piwik\Updates;

use Piwik\DataAccess\TableMetadata;
use Piwik\Date;
use Piwik\DbHelper;
use Piwik\Plugin\Manager;
use Piwik\Plugins\CoreHome\Columns\Profilable;
use Piwik\Plugins\CoreHome\Columns\VisitorSecondsSinceFirst;
use Piwik\Plugins\CoreHome\Columns\VisitorSecondsSinceOrder;
use Piwik\Plugins\Installation\ServerFilesGenerator;
use Piwik\Plugins\PagePerformance\Columns\TimeDomCompletion;
use Piwik\Plugins\PagePerformance\Columns\TimeDomProcessing;
use Piwik\Plugins\PagePerformance\Columns\TimeNetwork;
use Piwik\Plugins\PagePerformance\Columns\TimeOnLoad;
use Piwik\Plugins\PagePerformance\Columns\TimeServer;
use Piwik\Plugins\PagePerformance\Columns\TimeTransfer;
use Piwik\Plugins\UsersManager\Model;
use Piwik\Common;
use Piwik\Config;
use Piwik\Plugins\UserCountry\LocationProvider;
use Piwik\Plugins\VisitorInterest\Columns\VisitorSecondsSinceLast;
use Piwik\Updater;
use Piwik\Updates as PiwikUpdates;
use Piwik\Updater\Migration\Factory as MigrationFactory;

/**
 * Update for version 4.0.0-b1.
 */
class Updates_4_0_0_b1 extends PiwikUpdates
{
    /**
     * @var MigrationFactory
     */
    private $migration;

    public function __construct(MigrationFactory $factory)
    {
        $this->migration = $factory;
    }

    public function getMigrations(Updater $updater)
    {
        $tableMetadata = new TableMetadata();

        $columnsToAdd = [];

        $migrations = [];

        /** APP SPECIFIC TOKEN START */
        $migrations[] = $this->migration->db->createTable('user_token_auth', array(
            'idusertokenauth' => 'BIGINT UNSIGNED NOT NULL AUTO_INCREMENT',
            'login' => 'VARCHAR(100) NOT NULL',
            'description' => 'VARCHAR('.Model::MAX_LENGTH_TOKEN_DESCRIPTION.') NOT NULL',
            'password' => 'VARCHAR(191) NOT NULL',
            'system_token' => 'TINYINT(1) NOT NULL DEFAULT 0',
            'hash_algo' => 'VARCHAR(30) NOT NULL',
            'last_used' => 'DATETIME NULL',
            'date_created' => ' DATETIME NOT NULL',
            'date_expired' => ' DATETIME NULL',
        ), 'idusertokenauth');
        $migrations[] = $this->migration->db->addUniqueKey('user_token_auth', 'password', 'uniq_password');

        $migrations[] = $this->migration->db->dropIndex('user', 'uniq_keytoken');

        $userModel = new Model();
        foreach ($userModel->getUsers(array()) as $user) {
            if (!empty($user['token_auth'])) {
                $migrations[] = $this->migration->db->insert('user_token_auth', array(
                    'login' => $user['login'],
                    'description' => 'Created by Matomo 4 migration',
                    'password' => $userModel->hashTokenAuth($user['token_auth']),
                    'date_created' => Date::now()->getDatetime()
                ));
            }
        }

        /** APP SPECIFIC TOKEN END */

        // invalidations table
        $migrations[] = $this->migration->db->createTable('archive_invalidations', [
            'idinvalidation' => 'BIGINT UNSIGNED NOT NULL AUTO_INCREMENT',
            'idarchive' => 'INTEGER UNSIGNED NULL',
            'name' => 'VARCHAR(255) NOT NULL',
            'idsite' => 'INTEGER NOT NULL',
            'date1' => 'DATE NOT NULL',
            'date2' => 'DATE NOT NULL',
            'period' => 'TINYINT UNSIGNED NOT NULL',
            'ts_invalidated' => 'DATETIME NOT NULL',
            'ts_started' => 'DATETIME NULL',
            'status' => 'TINYINT(1) UNSIGNED DEFAULT 0',
            'report' => 'VARCHAR(255) NULL',
        ], ['idinvalidation']);

        $migrations[] = $this->migration->db->addIndex('archive_invalidations', ['idsite', 'date1', 'period'], 'index_idsite_dates_period_name');

        $migrations[] = $this->migration->db->dropColumn('user', 'alias');
        $migrations[] = $this->migration->db->dropColumn('user', 'token_auth');

	    // keep piwik_ignore for existing  installs
	    $migrations[] = $this->migration->config->set('Tracker', 'ignore_visits_cookie_name', 'piwik_ignore');

        $migrations[] = $this->migration->db->changeColumn('log_link_visit_action', 'interaction_position', 'pageview_position', 'MEDIUMINT UNSIGNED DEFAULT NULL');

        // Move the site search fields of log_visit out of custom variables into their own fields
        $columnsToAdd['log_link_visit_action']['search_cat'] = 'VARCHAR(200) NULL';
        $columnsToAdd['log_link_visit_action']['search_count'] = 'INTEGER(10) UNSIGNED NULL';

        // replace days to ... dimensions w/ seconds dimensions
        foreach (['log_visit', 'log_conversion'] as $table) {
            $columnsToAdd[$table]['visitor_seconds_since_first'] = VisitorSecondsSinceFirst::COLUMN_TYPE;
            $columnsToAdd[$table]['visitor_seconds_since_order'] = VisitorSecondsSinceOrder::COLUMN_TYPE;
        }
        $columnsToAdd['log_visit']['visitor_seconds_since_last'] = VisitorSecondsSinceLast::COLUMN_TYPE;
        $columnsToAdd['log_visit']['profilable'] = Profilable::COLUMN_TYPE;
        $columnsToAdd['log_link_visit_action'][TimeDomCompletion::COLUMN_NAME] = TimeDomCompletion::COLUMN_TYPE;
        $columnsToAdd['log_link_visit_action'][TimeDomProcessing::COLUMN_NAME] = TimeDomProcessing::COLUMN_TYPE;
        $columnsToAdd['log_link_visit_action'][TimeNetwork::COLUMN_NAME] = TimeNetwork::COLUMN_TYPE;
        $columnsToAdd['log_link_visit_action'][TimeOnLoad::COLUMN_NAME] = TimeOnLoad::COLUMN_TYPE;
        $columnsToAdd['log_link_visit_action'][TimeServer::COLUMN_NAME] = TimeServer::COLUMN_TYPE;
        $columnsToAdd['log_link_visit_action'][TimeTransfer::COLUMN_NAME] = TimeTransfer::COLUMN_TYPE;

        $columnsToMaybeAdd = ['revenue', 'revenue_discount', 'revenue_shipping', 'revenue_subtotal', 'revenue_tax'];
        $columnsLogConversion = $tableMetadata->getColumns(Common::prefixTable('log_conversion'));
        foreach ($columnsToMaybeAdd as $columnToMaybeAdd) {
            if (!in_array($columnToMaybeAdd, $columnsLogConversion, true)) {
                $columnsToAdd['log_conversion'][$columnToMaybeAdd] = 'DOUBLE NULL DEFAULT NULL';
            }
        }

        foreach ($columnsToAdd as $table => $columns) {
            $migrations[] = $this->migration->db->addColumns($table, $columns);

            foreach ($columns as $columnName => $columnType) {
                $optionKey = 'version_' . $table . '.' . $columnName;
                $optionValue = $columnType;

                if ($table == 'log_visit' && isset($columnsToAdd['log_conversion'][$columnName])) {
                    $optionValue .= '1'; // column is in log_conversion too
                }

                $migrations[] = $this->migration->db->sql("INSERT IGNORE INTO `" . Common::prefixTable('option')
                    . "` (option_name, option_value) VALUES ('$optionKey', '$optionValue')");
            }
        }

        // init seconds_to_... columns
        $logVisitColumns = $tableMetadata->getColumns(Common::prefixTable('log_visit'));
        $hasDaysColumnInVisit = in_array('visitor_days_since_first', $logVisitColumns);

        if ($hasDaysColumnInVisit) {
            $migrations[] = $this->migration->db->sql("UPDATE " . Common::prefixTable('log_visit')
                . " SET visitor_seconds_since_first = visitor_days_since_first * 86400, 
                    visitor_seconds_since_order = visitor_days_since_order * 86400,
                    visitor_seconds_since_last = visitor_days_since_last * 86400");
        }

        $logConvColumns = $tableMetadata->getColumns(Common::prefixTable('log_conversion'));
        $hasDaysColumnInConv = in_array('visitor_days_since_first', $logConvColumns);

        if ($hasDaysColumnInConv) {
            $migrations[] = $this->migration->db->sql("UPDATE " . Common::prefixTable('log_conversion')
                . " SET visitor_seconds_since_first = visitor_days_since_first * 86400, 
                    visitor_seconds_since_order = visitor_days_since_order * 86400");
        }

	    if (Manager::getInstance()->isPluginInstalled('CustomVariables')) {
		    $visitActionTable = Common::prefixTable('log_link_visit_action');
		    $migrations[]     = $this->migration->db->sql("UPDATE $visitActionTable SET search_cat = if(custom_var_k4 = '_pk_scat', custom_var_v4, search_cat), search_count = if(custom_var_k5 = '_pk_scount', custom_var_v5, search_count) WHERE custom_var_k4 = '_pk_scat' or custom_var_k5 = '_pk_scount'");
	    }

        // remove old days_to_... columns
        $migrations[] = $this->migration->db->dropColumns('log_visit', [
            'config_gears',
            'config_director',
            'visitor_days_since_first',
            'visitor_days_since_order',
            'visitor_days_since_last',
        ]);
        $migrations[] = $this->migration->db->dropColumns('log_conversion', [
            'visitor_days_since_first',
            'visitor_days_since_order',
        ]);

        $config = Config::getInstance();

        if (!empty($config->mail['type']) && $config->mail['type'] === 'Crammd5') {
            $migrations[] = $this->migration->config->set('mail', 'type', 'Cram-md5');
        }

        $migrations[] = $this->migration->plugin->activate('PagePerformance');
        if (!Manager::getInstance()->isPluginActivated('CustomDimensions')) {
            $migrations[] = $this->migration->plugin->activate('CustomDimensions');
        }

        $configTableLimit = Config::getInstance()->getFromLocalConfig('General')['datatable_archiving_maximum_rows_custom_variables'] ?? null;
        $configSubTableLimit = Config::getInstance()->getFromLocalConfig('General')['datatable_archiving_maximum_rows_subtable_custom_variables'] ?? null;

        if ($configTableLimit) {
            $migrations[] = $this->migration->config->set('General', 'datatable_archiving_maximum_rows_custom_dimensions', $configTableLimit);
        }
        if ($configSubTableLimit) {
            $migrations[] = $this->migration->config->set('General', 'datatable_archiving_maximum_rows_subtable_custom_dimensions', $configSubTableLimit);
        }

	    $migrations[] = $this->migration->db->changeColumnType('session', 'id', 'VARCHAR(191)');
	    $migrations[] = $this->migration->db->changeColumnType('site_url', 'url', 'VARCHAR(190)');
	    $migrations[] = $this->migration->db->changeColumnType('option', 'option_name', 'VARCHAR(191)');

	    $migrations[] = $this->migration->db->changeColumnType('log_action', 'name', 'VARCHAR(4096)');
	    $migrations[] = $this->migration->db->changeColumnType('log_conversion', 'url', 'VARCHAR(4096)');
        return $migrations;
    }

    public function doUpdate(Updater $updater)
    {
        $updater->executeMigrations(__FILE__, $this->getMigrations($updater));
    }

    protected function usesGeoIpLegacyLocationProvider()
    {
        $currentProvider = LocationProvider::getCurrentProviderId();

        return in_array($currentProvider, [
            'geoip_pecl',
            'geoip_php',
            'geoip_serverbased',
        ]);
    }
}
