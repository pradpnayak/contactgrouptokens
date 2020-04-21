<?php

require_once 'contactgrouptokens.civix.php';
use CRM_Contactgrouptokens_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function contactgrouptokens_civicrm_config(&$config) {
  _contactgrouptokens_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function contactgrouptokens_civicrm_xmlMenu(&$files) {
  _contactgrouptokens_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function contactgrouptokens_civicrm_install() {
  _contactgrouptokens_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function contactgrouptokens_civicrm_postInstall() {
  _contactgrouptokens_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function contactgrouptokens_civicrm_uninstall() {
  _contactgrouptokens_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function contactgrouptokens_civicrm_enable() {
  _contactgrouptokens_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function contactgrouptokens_civicrm_disable() {
  _contactgrouptokens_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function contactgrouptokens_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _contactgrouptokens_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function contactgrouptokens_civicrm_managed(&$entities) {
  _contactgrouptokens_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function contactgrouptokens_civicrm_caseTypes(&$caseTypes) {
  _contactgrouptokens_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function contactgrouptokens_civicrm_angularModules(&$angularModules) {
  _contactgrouptokens_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function contactgrouptokens_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _contactgrouptokens_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function contactgrouptokens_civicrm_entityTypes(&$entityTypes) {
  _contactgrouptokens_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_thems().
 */
function contactgrouptokens_civicrm_themes(&$themes) {
  _contactgrouptokens_civix_civicrm_themes($themes);
}

/**
 * Implements hook_civicrm_tokens().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_tokens
 */
function contactgrouptokens_civicrm_tokens(&$tokens) {
  $tokens['contactgroup'] = [
    'contactgroup.groups_comma' => 'Contact groups(comma separated)',
    'contactgroup.groups_list' => 'Contact groups(list)',
    'contactgroup.groups_visible_comma' => 'Contact visible groups(comma separated)',
    'contactgroup.groups_visible_list' => 'Contact visible groups(list)',
    'contactgroup.groups_restricted_comma' => 'Contact restricted groups(comma separated)',
    'contactgroup.groups_restricted_list' => 'Contact restricted groups(list)',
  ];
}

/**
 * get all public expose group.
 */
function _contactgrouptokens_civicrm_publicExposeGroup() {
  $groups = [];
  $condition = " visibility != 'User and User Admin Only'";
  CRM_Core_PseudoConstant::populate($groups, 'CRM_Contact_DAO_Group', FALSE, 'title', 'is_active', $condition, 'title');
  return $groups;
}

/**
 * Implements hook_civicrm_tokenValues().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_tokenValues
 */
function contactgrouptokens_civicrm_tokenValues(&$values, $cids, $job = NULL, $tokens = [], $context = NULL) {
  if (!empty($tokens['contactgroup'])) {
    foreach ($values as $cid => &$value) {
      $allGroups = CRM_Core_PseudoConstant::nestedGroup();
      $publicExposeGroup = _contactgrouptokens_civicrm_publicExposeGroup();
      $adminGroups = array_diff($allGroups, $publicExposeGroup);
      $contactGroups = civicrm_api3('Contact', 'getsingle', [
        'return' => ['group'],
        'id' => $cid,
      ])['groups'];
      $contactGroups = explode(',', trim($contactGroups));

      foreach ($tokens['contactgroup'] as $tokenName) {
        $tokenValue = '';
        $groupToCompare = $allGroups;
        switch ($tokenName) {
          case 'groups_restricted_comma' :
          case 'groups_restricted_list' :
            $groupToCompare = $adminGroups;
            break;
          case 'groups_visible_list' :
          case 'groups_visible_comma' :
            $groupToCompare = $publicExposeGroup;
            break;
        }

        if (!empty($contactGroups)) {
          switch ($tokenName) {
            case 'groups_restricted_comma' :
            case 'groups_visible_comma' :
            case 'groups_comma' :
              $tokenValue = array_intersect_key($groupToCompare, array_flip($contactGroups));
              $tokenValue = implode(', ', $tokenValue);
              break;
            case 'groups_list' :
            case 'groups_restricted_list' :
            case 'groups_visible_list' :
              $tokenValue = '<ul>';
              foreach ($contactGroups as $gid) {
                if (!empty($groupToCompare[$gid])) {
                  $tokenValue .= '<li>' . $allGroups[$gid] . '</li>';
                }
              }
              $tokenValue .= '</ul>';
              break;
          }
        }
        $value["contactgroup.{$tokenName}"] = $tokenValue;
      }
    }
  }
}
