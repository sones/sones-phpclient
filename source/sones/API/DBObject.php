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
include_once "../DataStructures/ObjectUUID.php";

/** @author Michael Schilonka
 */
class DBObject {
    /*
     * private members
     */

    /**
     * holds all attributes of the DBObject
     */
    public $Attributes;

    public function __construct() {
        $this->Attributes = array();
    }

    /*
     * getter / setter
     */

    /**
     * Returns all attributes of that DBObject
     * 
     * @return array of all attributes
     */
    public function getAttributes() {
        return $this->Attributes;
    }

    /**
     * Returns the ObjectUUID for that DBObject.
     * 
     * @return ObjectUUID or null if no uuid is assigned.
     */
    public function getUUID() {
        if ($this->Attributes["UUID"] != null) {
            return new ObjectUUID($this->Attributes["UUID"]);
        }
    }

    /**
     * Sets the UUID of the DBObject. Existing UUID will be replaced.
     * 
     * @param myObjectUUID
     */
    public function setUUID($myObjectUUDI) {

        $this->Attributes["UUID"] = $myObjectUUDI;
    }

    /**
     * Sets the TYPE of the DBObject. Existing TYPE will be replaced.
     * 
     * @param myType the type to be set
     */
    public function setType($myType) {
        $this->Attributes["Type"] = $myType;
    }

    /**
     * Returns the TYPE for that DBObject.
     * 
     * @return The Object TYPE or null if no type is assigned.
     */
    public function getType() {
        if (array_keys($this->Attributes, "Type")) {
            return $this->Attributes["Type"];
        }
    }

    /**
     * Sets the EDITION of the DBObject. Existing EDITION will be replaced.
     * 
     * @param myEdition the edition to be set
     */
    public function setEdition($myEdition) {
        $this->Attributes["EDITION"] = $myEdition;
    }

    /**
     * Returns the EDITION for that DBObject.
     * 
     * @return The Object EDITION or null if no type is assigned.
     */
    public function getEdition() {
        if (array_keys($this->Attributes, "EDITION")) {
            return $this->Attributes["EDITION"];
        }
    }

    /**
     * Sets the REVISION of the DBObject. Existing REVISION will be replaced.
     * 
     * @param myObjectRevisionID the revision to be set
     */
    public function setRevisionID($myRevision) {
        $this->Attributes["REVISION"] = $myRevision;
    }

    /**
     * Returns the REVISION for that DBObject.
     * 
     * @return The Object REVISION or null if no revision is assigned.
     */
    public function getRevisionID() {
        if ($this->Attributes["REVISION"] != null) {
            return new ObjectRevisionID($this->Attributes["REVISION"]);
        }
    }

    /**
     * Sets the Comment of the DBObject. Existing Comment will be replaced.
     * 
     * @param myComment the comment to be set
     */
    public function setComment($myComment) {
        $this->Attributes["COMMENT"] = $myComment;
    }

    /**
     * Returns the Comment for that DBObject.
     * 
     * @return Comment or null if no comment is assigned.
     */
    public function getComment() {
        if ($this->Attributes["COMMENT"] != null) {
            return $this->Attributes["COMMENT"];
        }
    }

    /**
     * Returns the number of attributes assigned to that object.
     * 
     * @return number of attributes
     */
    public function getAttributesCount() {
        return array_count_values($this->Attributes);
    }

    /**
     * Checks if attribute is existing.
     * 
     * @param myAttributeName the attribute to be checked
     * 
     * @return <tt>true</tt> if the attribute exists else <tt>false</tt>
     */
    public function hasAttribute($myAttributeName) {
        return array_key_exists($myAttributeName, $this->Attributes);
    }

    /**
     * Adds new attributes or replaces existing ones.
     * 
     * @param myAttributeName the name of the attribute
     * @param myObject the assigned attribute value
     */
    public function addOrUpdateAttribute($myAttributeName, $myObject) {

        $this->Attributes[$myAttributeName] = $myObject;
    }

    /**
     * Removes existing attribute.
     * 
     * @param myAttributeName
     * @return <tt>true</tt> if the attribute existed, else <tt>false</tt>
     */
    public function removeAttribute($myAttributeName) {
        unset($this->Attributes[$myAttributeName]);
    }

}

?>
