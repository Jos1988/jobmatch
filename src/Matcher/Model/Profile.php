<?php

namespace App\Matcher\Model;

/**
 * Created by PhpStorm.
 * User: Jos
 * Date: 3-4-2018
 * Time: 22:03
 */

class Profile
{

    /**
     * @var int|null
     */
    public $IE;

    /**
     * @var int|null
     */
    public $SN;

    /**
     * @var int|null
     */
    public $TF;

    /**
     * @var int|null
     */
    public $PJ;

    /**
     * @var int|null
     */
    public $TS;

    /**
     * @var int|null
     */
    public $MHW;

    /**
     * get IE
     *
     * @return int
     */
    public function getIE(): ?int
    {
        return $this->IE;
    }

    /**
     * set IE
     *
     * @param int $IE
     *
     * @return $this
     */
    public function setIE(int $IE): self
    {
        $this->IE = $IE;

        return $this;
    }

    /**
     * get SN
     *
     * @return int
     */
    public function getSN(): ?int
    {
        return $this->SN;
    }

    /**
     * set SN
     *
     * @param int $SN
     *
     * @return $this
     */
    public function setSN(int $SN): self
    {
        $this->SN = $SN;

        return $this;
    }

    /**
     * get TF
     *
     * @return int
     */
    public function getTF(): ?int
    {
        return $this->TF;
    }

    /**
     * set TF
     *
     * @param int $TF
     *
     * @return $this
     */
    public function setTF(int $TF): self
    {
        $this->TF = $TF;

        return $this;
    }

    /**
     * get PJ
     *
     * @return int
     */
    public function getPJ(): ?int
    {
        return $this->PJ;
    }

    /**
     * set PJ
     *
     * @param int $PJ
     *
     * @return $this
     */
    public function setPJ(int $PJ): self
    {
        $this->PJ = $PJ;

        return $this;
    }

    /**
     * get TD
     *
     * @return int
     */
    public function getTS(): ?int
    {
        return $this->TS;
    }

    /**
     * set TD
     *
     * @param int $TS
     *
     * @return $this
     */
    public function setTS(int $TS): self
    {
        $this->TS = $TS;

        return $this;
    }

    /**
     * get MHW
     *
     * @return int
     */
    public function getMHW(): ?int
    {
        return $this->MHW;
    }

    /**
     * set MHW
     *
     * @param int $MHW
     *
     * @return $this
     */
    public function setMHW(int $MHW): self
    {
        $this->MHW = $MHW;

        return $this;
    }
}