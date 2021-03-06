<?php

/**
 * @file
 * Contains Drupal\account\DayAccessController.
 */

namespace Drupal\mespronos;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;
use Drupal\user\Entity\User;

/**
 * Access controller for the Day entity.
 *
 * @see \Drupal\mespronos\Entity\Day.
 */
class DayAccessControlHandler extends EntityAccessControlHandler
{

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    if(is_null($account)) {
      $account = User::load(\Drupal::currentUser()->id());
    }
    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view Day entity');
        break;

      case 'edit':
        return AccessResult::allowedIfHasPermission($account, 'edit Day entity');
        break;

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete Day entity');
        break;

    }

    return AccessResult::allowed();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add Bar entity');
  }
}
