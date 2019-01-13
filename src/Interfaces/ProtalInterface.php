<?php
/* 
 * @Author: Megoc 
 * @Date: 2019-01-12 11:58:00 
 * @Last Modified by: Megoc
 * @Last Modified time: 2019-01-12 11:58:35
 * @E-mail: megoc@megoc.org 
 * @Description: Create by vscode 
 */

namespace Megoc\Ecjtu\Interfaces;

interface ProtalInterface
{
    /**
     * notifications list
     *
     * @param integer $page
     * @param integer $page_size
     * @return array
     */
    public function notifications($page = 1, $page_size = 10);
    /**
     * notification detail
     *
     * @param string $resource_id
     * @return array
     */
    public function notification_detail($resource_id = '');
    /**
     * lost notifications
     *
     * @param integer $page
     * @param integer $page_size
     * @return array
     */
    public function lost_notifications($page = 1, $page_size = 10);
    /**
     * protal profile
     *
     * @return array
     */
    public function profile();
    /**
     * education manager system cas link url
     *
     * @return string
     */
    public function education_cas_link();
    /**
     * elective manager system cas link url
     *
     * @return string
     */
    public function elective_cas_link();
    /**
     * library manager system cas link url
     *
     * @return string
     */
    public function library_cas_link();
    /**
     * any service cas link url
     *
     * @param string $service_cas_url
     * @return string
     */
    public function cas_authority($service_cas_url = '');

}