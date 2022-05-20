<?php

declare(strict_types=1);

/*
 * This file is part of the Gitlab API library.
 *
 * (c) Matt Humphrey <matth@windsor-telecom.co.uk>
 * (c) Graham Campbell <hello@gjcampbell.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitlab\Api;

class Commits extends AbstractApi
{
  /**
   * @param int|string $project_id
   * @param array      $parameters {
   *
   *     @var string $order_by                    Return deployments ordered by id, iid, created_at, updated_at,
   *                                              or ref fields (default is id)
   *     @var string $sort                        Return deployments sorted in asc or desc order (default is desc)
   * }
   *
   * @return mixed
   */
  public function all($project_id, array $parameters = [])
  {
    $resolver = $this->createOptionsResolver();
    $resolver->setDefined('all')
             ->setAllowedTypes('all', 'boolean');
    $resolver->setDefined('first_parent')
             ->setAllowedTypes('first_parent', 'boolean');
    $resolver->setDefined('ref_name')
             ->setAllowedTypes('ref_name', 'string');
    $resolver->setDefined('since')
             ->setAllowedTypes('since', 'string');
    $resolver->setDefined('order')
             ->setAllowedTypes('order', 'string');

    return $this->get($this->getProjectPath($project_id, 'repository/commits'), $resolver->resolve($parameters));
  }

  /**
   * @param int|string $project_id
   * @param string        $commit_sha
   *
   * @return mixed
   */
  public function show($project_id, string $commit_sha)
  {
    return $this->get($this->getProjectPath($project_id, 'repository/commits/'.$commit_sha));
  }
}
