<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Recipe;
use Illuminate\Support\Str;

class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        $recipes = [
            [
                'user_id' => 1,
                'name' => 'Healthy Rich Salad',
                'img' => '/images/recipe/salad.jpg',
                'bio' => 'This healthy salad is packed with vibrant greens, nuts, and a zesty vinaigrette. Perfect for a light lunch or side dish. It’s easy, fast, and incredibly nutritious!',
                'cookMinutes' => 12,
                'instructions' => json_encode([
                    'Wash the lettuce, tomatoes, and cucumber thoroughly.',
                    'Slice the cucumber and tomatoes. Chop the lettuce into bite-sized pieces.',
                    'Slice the avocado in half, remove the seed, and scoop out the flesh. Slice it into pieces.',
                    'In a large mixing bowl, combine lettuce, tomatoes, cucumber, and avocado.',
                    'Add walnuts and feta cheese, and drizzle with your favorite vinaigrette dressing.',
                    'Toss everything gently to combine and serve immediately.'
                ]),
            ],
            [
                'user_id' => 1,
                'name' => 'Butter Chicken',
                'img' => '/images/recipe/butter-chicken-test.jpg',
                'bio' => 'Butter Chicken is a rich and creamy Indian dish made with tender chicken in a spiced tomato sauce. Serve it with naan or basmati rice for a satisfying meal.',
                'cookMinutes' => 15,
                'instructions' => json_encode([
                    'Start by marinating the chicken. In a bowl, mix the chicken with yogurt, garam masala, turmeric, cumin, and a pinch of salt. Let it marinate for at least 30 minutes.',
                    'Heat butter in a large pan over medium heat. Add chopped onions and sauté until golden brown.',
                    'Add minced garlic and grated ginger, cooking for another 1-2 minutes until fragrant.',
                    'Add the marinated chicken to the pan, cooking until browned on all sides.',
                    'Pour in the tomato puree and add some water or chicken broth to create a sauce. Simmer for about 10 minutes, allowing the chicken to cook through.',
                    'Stir in cream and adjust the seasoning with salt and pepper.',
                    'Serve hot with basmati rice or naan bread.'
                ]),
            ],
            // New recipes
            [
                'user_id' => 1,
                'name' => 'Classic Spaghetti Bolognese',
                'img' => '/images/recipe/spaghetti-bolognese.jpg',
                'bio' => 'A comforting, rich pasta dish with a savory bolognese sauce made with ground beef and tomatoes, perfect for any occasion.',
                'cookMinutes' => 30,
                'instructions' => json_encode([
                    'Bring a large pot of salted water to a boil. Cook spaghetti according to package instructions, then drain and set aside.',
                    'In a large pan, heat olive oil over medium heat. Add chopped onion and garlic and sauté until soft and translucent.',
                    'Add the ground beef to the pan, breaking it up with a spoon. Cook until browned, then season with salt, pepper, and Italian herbs.',
                    'Stir in the tomato puree and let the sauce simmer for 15-20 minutes, stirring occasionally.',
                    'Once the sauce has thickened, add a splash of red wine or broth if needed to loosen it up.',
                    'Toss the spaghetti with the sauce and serve with freshly grated parmesan cheese on top.'
                ]),
            ],
            [
                'user_id' => 1,
                'name' => 'Creamy Mushroom Risotto',
                'img' => '/images/recipe/mushroom-risotto.jpg',
                'bio' => 'A rich, creamy risotto made with mushrooms and parmesan cheese, this dish is a comforting vegetarian delight.',
                'cookMinutes' => 40,
                'instructions' => json_encode([
                    'In a large pot, heat butter over medium heat. Add chopped onion and garlic, cooking until softened.',
                    'Add sliced mushrooms to the pan and sauté until they release their moisture and begin to brown.',
                    'Stir in the rice, allowing it to toast lightly for 1-2 minutes.',
                    'Gradually add vegetable broth, one ladle at a time, stirring constantly. Wait until the liquid is absorbed before adding more broth.',
                    'Continue adding broth and stirring until the rice is tender and creamy, about 18-20 minutes.',
                    'Finish the risotto by stirring in cream and parmesan cheese until the cheese is melted and the risotto is creamy.',
                    'Serve immediately with additional parmesan and freshly cracked black pepper.'
                ]),
            ],
            [
                'user_id' => 1,
                'name' => 'Vegetarian Stir Fry',
                'img' => '/images/recipe/vegeterian-stir-fry.jpg',
                'bio' => 'A quick and healthy stir fry with a mix of colorful vegetables, served with rice or noodles for a balanced meal.',
                'cookMinutes' => 15,
                'instructions' => json_encode([
                    'Start by preparing all the vegetables: chop the broccoli into florets, slice the bell peppers and carrots, and mince the garlic and ginger.',
                    'Heat sesame oil in a large pan or wok over medium-high heat.',
                    'Add garlic and ginger, sautéing until fragrant, about 1 minute.',
                    'Add the vegetables to the pan, stir-frying for 5-7 minutes until tender-crisp.',
                    'In a small bowl, whisk together soy sauce, honey, and a dash of sesame oil.',
                    'Pour the sauce over the vegetables and stir to coat. Cook for another 2-3 minutes.',
                    'Serve the stir-fry over steamed rice or noodles.'
                ]),
            ],
            [
                'user_id' => 1,
                'name' => 'Baked Salmon with Veggies',
                'img' => '/images/recipe/baked-salmon-with-veggies.jpeg',
                'bio' => 'A light and healthy baked salmon dish served with roasted vegetables, making for an easy, nutritious dinner.',
                'cookMinutes' => 20,
                'instructions' => json_encode([
                    'Preheat your oven to 375°F (190°C). Line a baking sheet with parchment paper.',
                    'Place the salmon fillets on the baking sheet. Drizzle them with olive oil and season with salt and pepper.',
                    'Chop carrots, zucchini, and bell peppers into bite-sized pieces, and toss them in olive oil, salt, and pepper.',
                    'Spread the vegetables around the salmon on the baking sheet. Bake for 15 minutes or until the salmon flakes easily with a fork.',
                    'Serve the salmon fillets with the roasted vegetables, garnished with fresh herbs if desired.'
                ]),
            ],
            [
                'user_id' => 1,
                'name' => 'Avocado Toast with Egg',
                'img' => '/images/recipe/avacado-toast-with-egg.jpg',
                'bio' => 'A simple and healthy breakfast with creamy avocado spread over toasted bread, topped with a perfectly fried egg.',
                'cookMinutes' => 10,
                'instructions' => json_encode([
                    'Toast the slices of bread to your preferred crispness.',
                    'While the bread is toasting, mash the avocado in a bowl with a pinch of salt and a squeeze of lemon juice.',
                    'Heat a non-stick pan over medium heat and cook the egg to your desired doneness (fried or poached).',
                    'Spread the mashed avocado evenly on each slice of toast.',
                    'Top with the fried egg and season with additional salt and pepper to taste.'
                ]),
            ],
            [
                'user_id' => 1,
                'name' => 'Spicy Chickpea Curry',
                'img' => '/images/recipe/chickpea-curry-recipe.jpg',
                'bio' => 'A flavorful and spicy chickpea curry served with rice or naan, perfect for a hearty vegetarian meal.',
                'cookMinutes' => 30,
                'instructions' => json_encode([
                    'In a large pot, heat oil over medium heat. Add chopped onions, garlic, and ginger, sautéing until softened.',
                    'Add cumin, paprika, turmeric, and chili powder, cooking for 1-2 minutes to toast the spices.',
                    'Stir in the chickpeas, tomato puree, and a splash of water or broth. Let it simmer for 15 minutes.',
                    'Add coconut milk and continue cooking for another 5 minutes, allowing the flavors to meld.',
                    'Serve hot with rice or naan bread.'
                ]),
            ],
            [
                'user_id' => 1,
                'name' => 'Grilled Chicken Caesar Salad',
                'img' => '/images/recipe/grilled-chicken-ceaser-salad.jpg',
                'bio' => 'A classic Caesar salad topped with grilled chicken, crispy croutons, and a tangy homemade dressing.',
                'cookMinutes' => 20,
                'instructions' => json_encode([
                    'Season the chicken breasts with salt, pepper, and olive oil. Grill over medium heat for 6-7 minutes per side until cooked through.',
                    'While the chicken cooks, chop the lettuce into bite-sized pieces and prepare the croutons.',
                    'In a small bowl, whisk together Caesar dressing, lemon juice, and a little olive oil.',
                    'Once the chicken is cooked, slice it thinly and add it to the salad.',
                    'Toss the lettuce, croutons, and dressing together and top with parmesan cheese and the sliced chicken.'
                ]),
            ],
            [
                'user_id' => 1,
                'name' => 'Stuffed Bell Peppers',
                'img' => '/images/recipe/stuffed-belled-pepper.jpg',
                'bio' => 'Colorful bell peppers stuffed with rice, ground beef, and a savory tomato sauce, then baked to perfection.',
                'cookMinutes' => 45,
                'instructions' => json_encode([
                    'Preheat the oven to 375°F (190°C).',
                    'Cut the tops off the bell peppers and remove the seeds and membranes.',
                    'In a skillet, brown the ground beef with diced onions and garlic until cooked through.',
                    'Add cooked rice, tomato puree, oregano, salt, and pepper, stirring to combine.',
                    'Stuff the peppers with the mixture and place them in a baking dish.',
                    'Cover with foil and bake for 30 minutes, then remove the foil and bake for an additional 10 minutes.'
                ]),
            ],
            [
                'user_id' => 1,
                'name' => 'Peanut Butter Banana Smoothie',
                'img' => '/images/recipe/peanut-butter-smoothie.jpg',
                'bio' => 'A quick and creamy smoothie made with peanut butter, banana, and milk, perfect for a quick breakfast or snack.',
                'cookMinutes' => 5,
                'instructions' => json_encode([
                    'Peel the banana and add it to a blender with peanut butter, milk, and ice.',
                    'Blend until smooth and creamy. Adjust sweetness with honey or maple syrup if needed.',
                    'Serve immediately in a chilled glass.'
                ]),
            ],
            [
                'user_id' => 1,
                'name' => 'Tomato Basil Soup',
                'img' => '/images/recipe/tomato-basil-soup.jpg',
                'bio' => 'A classic, comforting tomato soup made with fresh tomatoes, garlic, and basil, served with crusty bread.',
                'cookMinutes' => 30,
                'instructions' => json_encode([
                    'In a large pot, sauté chopped onions and garlic in olive oil until softened.',
                    'Add chopped tomatoes, vegetable broth, and fresh basil leaves.',
                    'Simmer for 20 minutes until the flavors are well combined.',
                    'Use an immersion blender to blend the soup until smooth, or blend in batches using a regular blender.',
                    'Season with salt and pepper, and serve with fresh basil and crusty bread.'
                ]),
            ],
        ];

        foreach ($recipes as &$recipe) {
            $recipe['slug'] = Str::slug($recipe['name']);
        }

        Recipe::insert($recipes);
    }
}
