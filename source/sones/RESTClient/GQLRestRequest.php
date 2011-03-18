<?php

/*
 * sones GraphDB - OpenSource Graph Database - http://www.sones.com
 * Copyright (C) 2007-2010 sones GmbH
 *
 * This file is part of sones GraphDB OpenSource Edition.
 *
 * sones GraphDB OSE is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, version 3 of the License.
 *
 * sones GraphDB OSE is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with sones GraphDB OSE. If not, see <http://www.gnu.org/licenses/>.
 */

/** @author Michael Schilonka
 */
class GQLRestRequest {

    private $Data;
    private $acceptType;
    private $Verb;
    private $ResponseBody;
    private $ResponseInfo;
    private $Cred = null;
    private $UriGQLQuery;

    public function __construct($UriGQLQuery, $Credentials, $acceptType) {

        $this->UriGQLQuery = $UriGQLQuery;
        $this->acceptType = $acceptType;
        $this->Verb = "GET";
        $this->ResponseBody = null;
        $this->ResponseInfo = null;
        $this->Data = null;
        $this->Cred = $Credentials;

        $this->Execute();
        return $this;
    }

    /**
     * Connection settings
     * @param cureHandle reference of the curl type
     */
    private function setCurlOpts(&$curlHandle) {
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
        curl_setopt($curlHandle, CURLOPT_URL, $this->UriGQLQuery);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array('Accept: ' . $this->acceptType));
    }

    private function setAuth(&$curlHandle) {
        if ($this->Cred->getUsername() !== null && $this->Cred->getPassword() !== null) {
            curl_setopt($curlHandle, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curlHandle, CURLOPT_USERPWD, $this->Cred->getUsername() . ':' . $this->Cred->getPassword());
        }
    }

    private function Execute() {
        try {
            $ch = curl_init();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        try {
            $this->setCurlOpts($ch);
            $this->setAuth($ch);
            $this->ResponseBody = curl_exec($ch);
            $this->ResponseInfo = curl_getinfo($ch);
            curl_close($ch);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Returns the XML Response
     * 
     * @return String XML as String
     */
    public function getResponseBody() {
        if ($this->ResponseBody != false) {
            return $this->ResponseBody;
        }
        else
            return false;
    }

}

?>
