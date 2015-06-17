<?php

namespace Uthmordar\Cardator\Card;

/**
 * regroup all card transform operations, such as filter, output formatting or post processing
 */
class CardProcessor extends CardContainer {

    protected $filter = [];
    private $except = [];
    private $only = [];

    /**
     * get cards from container as json output or store in iterable collection
     * 
     * @param boolean $json true: result as json_encode, false: result as SPLObjectStorage collection
     * @return \Uthmordar\Cardator\Card\CardContainer
     */
    public function getCards($json = false) {
        if ($json) {
            return $this->formatCollectionToJson();
        }
        $collection = new CardCollection;
        foreach ($this as $card) {
            if ($this->isAllowedType($card->getQualifiedName())) {
                $collection->attach($card);
            }
        }
        return $collection;
    }

    /**
     * get cards from container without applying filter
     * 
     * @return \Uthmordar\Cardator\Card\CardContainer
     */
    public function getNonFilterCards() {
        $cards = [];
        foreach ($this as $card) {
            $cards[] = $card;
        }
        return $cards;
    }

    /**
     * add given card type in only type card returned
     * cardQualifiedName or cardQualifiedName array if an array is provided then this array erase previous only array
     * 
     * @param string or array $cardType
     */
    public function addOnly($cardType) {
        if (is_array($cardType)) {
            $this->only = $cardType;
        } else {
            $this->only[] = $cardType;
        }
    }

    /**
     * add given card type in except type card which will not be returned
     * cardQualifiedName or cardQualifiedName array $cardType if an array is provided then this array erase previous exception array
     * 
     * @param string or array $cardType
     */
    public function addExcept($cardType) {
        if (is_array($cardType)) {
            $this->except = $cardType;
        } else {
            $this->except[] = $cardType;
        }
    }

    /**
     * 
     * @param cardQualifiedName $type
     */
    private function isAllowedType($type) {
        if (empty($this->only) && empty($this->except)) {
            return $type;
        } else if (in_array($type, $this->except)) {
            return false;
        } else if (in_array($type, $this->only)) {
            return false;
        }
        return $type;
    }

    /**
     * add custom filter
     * 
     * @param string $name card property
     * @param \Closure $filter ($name, $value)
     */
    public function addPostProcessTreatment($name, \Closure $filter) {
        $this->filter[$name] = $filter;
        return $this;
    }

    /**
     * run post processing procedure
     */
    public function doPostProcess() {
        foreach ($this as $card) {
            foreach ($this->filter as $prop => $closure) {
                $this->applyFilterOnProperty($card, $prop, $closure);
            }
        }
    }

    /**
     * filter on property
     * 
     * @param iCard $card
     * @param string $prop property
     * @param Closure $closure
     * @return boolean
     */
    public function applyFilterOnProperty(lib\iCard $card, $prop, \Closure $closure) {
        try {
            $card->$prop(['filtered' => $this->getFilterResultOnProperty($card, $prop, $closure), 'replace' => true]);
        } catch (\RuntimeException $e) {
            return false;
        }
    }

    /**
     * get post filter properties value or array of post filter properties value
     * 
     * @param \Uthmordar\Cardator\Card\lib\iCard $card
     * @param string or array $prop
     * @param Closure $closure
     * @return string or array
     */
    public function getFilterResultOnProperty(lib\iCard $card, $prop, \Closure $closure) {
        if (is_array($card->$prop)) {
            $r = [];
            foreach ($card->$prop as $k => $p) {
                $r[$k] = $closure($prop, $p);
            }
        } else {
            $r = $closure($prop, $card->$prop);
        }
        return $r;
    }

    /**
     * return attach card as json
     * @return json
     */
    private function formatCollectionToJson() {
        $data = [];
        foreach ($this as $card) {
            $k = $this->createArrayCard($card);
            $data[] = $k;
        }
        return json_encode($data);
    }

    /**
     * create an array from a Card object
     * 
     * @param \Uthmordar\Cardator\Card\lib\iCard $card
     * @return array
     */
    public function createArrayCard(lib\iCard $card) {
        $array = [
            'type' => $card->type,
            'class' => $card->getQualifiedName()
        ];
        foreach ($card->properties as $property) {
            $array = $this->formatProperties($card, $property, $array);
        }
        return $array;
    }

    /**
     * parse property value differently if it is an array or a single value
     * 
     * @param \Uthmordar\Cardator\Card\lib\iCard $card
     * @param string $property
     * @param array $array
     * @return type
     */
    public function formatProperties(lib\iCard $card, $property, array $array) {
        if (is_array($card->$property)) {
            foreach ($card->$property as $p) {
                $array[$property][] = (is_string($p)) ? utf8_encode($this->formatToJsonCardProperties($p)) : $this->formatToJsonCardProperties($p);
            }
        } else {
            $array[$property] = (is_string($card->$property)) ? utf8_encode($this->formatToJsonCardProperties($card->$property)) : $this->formatToJsonCardProperties($card->$property);
        }
        return $array;
    }

    /**
     * return stringified data from different input types (Card, Datetime, string)
     * 
     * @param string $propertyValue
     * @return string stringified value
     */
    public function formatToJsonCardProperties($propertyValue) {
        if ($propertyValue instanceof \DateTime) {
            return $propertyValue->getTimestamp();
        }
        if ($propertyValue instanceof lib\iCard) {
            return $this->createArrayCard($propertyValue);
        }
        return $propertyValue;
    }

}
