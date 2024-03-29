<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $pk_household_id
 * @property string $household_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Household newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Household newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Household query()
 * @method static \Illuminate\Database\Eloquent\Builder|Household whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Household whereHouseholdName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Household wherePkHouseholdId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Household whereUpdatedAt($value)
 */
	class Household extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder|HouseholdRecipe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HouseholdRecipe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HouseholdRecipe query()
 */
	class HouseholdRecipe extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $pk_ingredient_id
 * @property string $ingredient_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Ingredient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ingredient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ingredient query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ingredient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ingredient whereIngredientName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ingredient wherePkIngredientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ingredient whereUpdatedAt($value)
 */
	class Ingredient extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $pk_product_id
 * @property int $fk_ingredient_id
 * @property string $product_name
 * @property string $product_company
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereFkIngredientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePkProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereProductCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStore newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStore newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStore query()
 */
	class ProductStore extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $pk_recipe_id
 * @property string $recipe_name
 * @property string $recipe_description
 * @property string $recipe_instructions
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe query()
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe wherePkRecipeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereRecipeDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereRecipeInstructions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereRecipeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereUpdatedAt($value)
 */
	class Recipe extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeIngredient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeIngredient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeIngredient query()
 */
	class RecipeIngredient extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ShoppingList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShoppingList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShoppingList query()
 */
	class ShoppingList extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ShoppingListProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShoppingListProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShoppingListProduct query()
 */
	class ShoppingListProduct extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $pk_store_id
 * @property string $store_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Store newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Store newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Store query()
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store wherePkStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereStoreName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereUpdatedAt($value)
 */
	class Store extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $pk_user_id
 * @property string $username
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserHousehold> $user_household
 * @property-read int|null $user_household_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePkUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\Authenticatable, \Illuminate\Contracts\Auth\Access\Authorizable {}
}

namespace App\Models{
/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder|UserHousehold newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserHousehold newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserHousehold query()
 */
	class UserHousehold extends \Eloquent {}
}

