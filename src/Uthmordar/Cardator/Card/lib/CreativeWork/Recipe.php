<?php

namespace Uthmordar\Cardator\Card\lib;

class Recipe extends CreativeWork {

    protected $parents = "Thing\CreativeWork";
    protected $cookTime;
    protected $cookingMethod;
    protected $nutrition;
    protected $prepTime;
    protected $recipeCategory;
    protected $recipeCuisine;
    protected $recipeIngredient;
    protected $recipeInstructions;
    protected $recipeYield;
    protected $totalTime;
    protected $type = "http://schema.org/Recipe";

}
