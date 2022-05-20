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

class Releases extends AbstractApi
{

  /**
   * @param int|string $project_id
   * @param array      $parameters {
   *
   * }
   *
   * @return mixed
   */
  public function all($project_id, array $parameters = [])
  {
    $resolver = $this->createOptionsResolver();

    return $this->get($this->getProjectPath($project_id, 'releases'), $resolver->resolve($parameters));
  }

  /**
   * @param int|string $project_id
   * @param int        $release_id
   *
   * @return mixed
   */
  public function show($project_id, int $release_id)
  {
    return $this->get($this->getProjectPath($project_id, 'releases/'.self::encodePath($release_id)));
  }

  /**
   * @param int|string $project_id
   * @param array      $params
   *
   * @return mixed
   */
  public function create($project_id, array $params)
  {
    return $this->post($this->getProjectPath($project_id, 'releases'), $params);
  }

  /**
   * @param int|string $project_id
   * @param string        $tag_name
   * @param array      $params
   *
   * @return mixed
   */
  public function update($project_id, string $tag_name, array $params)
  {
    return $this->put($this->getProjectPath($project_id, 'releases/'.self::encodePath($tag_name)), $params);
  }

  /**
   * @param int|string $project_id
   * @param string        $tag_name
   *
   * @return mixed
   */
  public function remove($project_id, string $tag_name)
  {
    return $this->delete($this->getProjectPath($project_id, 'releases/'.self::encodePath($tag_name)));
  }

  /**
   * @param int|string $project_id
   * @param string        $tag_name
   *
   * @return mixed
   */
  public function evidence($project_id, string $tag_name)
  {
    return $this->post($this->getProjectPath($project_id, 'releases/'.self::encodePath($tag_name).'/evidence'), ['as_response' => true]);
  }
}
