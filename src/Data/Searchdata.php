<?php
namespace App\Data;

use App\Entity\Auteur;
use App\Entity\Genre;
use Symfony\Component\Validator\Constraints\Date;

class  Searchdata
{
  /**
   * @var string
   */
  public $q='';

    /**
     * @var Genre[]
     */
  public $genres=[];

    /**
     * @var null|integer
     */
  public  $max;

    /**
     * @var null|integer
     */
  public  $min;

  /**
   * @var Auteur[]
   */
  public $auteurs=[];
}