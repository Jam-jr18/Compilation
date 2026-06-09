<?php

namespace Database\Seeders;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\RestaurantTable;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Burgers', 'sort_order' => 1, 'items' => [
                ['BeeHive Signature Burger', 'Double beef patty with special honey-mustard sauce and caramelized onions.', 185, '#b45309'],
                ['Hive Classic Cheeseburger', 'Beef patty with cheese, lettuce, tomato, and house sauce.', 145, '#d97706'],
            ]],
            ['name' => 'Chicken', 'sort_order' => 2, 'items' => [
                ['Honey Butter Wings', 'Six-piece crispy wings glazed with honey butter.', 220, '#f59e0b'],
                ['Worker Bee Platter', 'Chicken platter with fries, dip, and side salad.', 450, '#f97316'],
            ]],
            ['name' => 'Rice', 'sort_order' => 3, 'items' => [
                ['BeeF Tapa Rice', 'Sweet-savory tapa with garlic rice and egg.', 195, '#92400e'],
                ['Chicken Teriyaki Bowl', 'Grilled chicken with teriyaki glaze over warm rice.', 180, '#b45309'],
            ]],
            ['name' => 'Drinks', 'sort_order' => 4, 'items' => [
                ['Iced Honey Lemon Tea', 'Refreshing lemon tea with honey syrup.', 95, '#fde047'],
                ['Mango Hive Shake', 'Creamy mango shake with whipped topping.', 120, '#facc15'],
            ]],
            ['name' => 'Desserts', 'sort_order' => 5, 'items' => [
                ['Honey Toast Bites', 'Crisp toast cubes with honey drizzle and cream.', 135, '#fbbf24'],
                ['BeeHive Sundae', 'Vanilla sundae with caramel, cookie bits, and honey.', 150, '#fef3c7'],
            ]],
            ['name' => 'Snacks', 'sort_order' => 6, 'items' => [
                ['Golden Bee Fries', 'Seasoned fries with cheese sauce and honey drizzle.', 95, '#facc15'],
                ['Nacho Swarm', 'Nachos with beef, salsa, cheese, and jalapeños.', 175, '#fb923c'],
            ]],
        ];

        foreach ($categories as $categoryData) {
            $category = MenuCategory::create([
                'name' => $categoryData['name'],
                'slug' => Str::slug($categoryData['name']),
                'sort_order' => $categoryData['sort_order'],
            ]);

            foreach ($categoryData['items'] as [$name, $description, $price, $color]) {
                MenuItem::create([
                    'menu_category_id' => $category->id,
                    'name' => $name,
                    'description' => $description,
                    'price' => $price,
                    'image_base64' => $this->svgDataUri($name, $color),
                    'is_available' => true,
                ]);
            }
        }

        foreach ([
            ['Table 1', 2], ['Table 2', 2], ['Table 3', 4], ['Table 4', 4],
            ['Table 5', 6], ['Table 6', 6], ['Patio A', 4], ['Patio B', 4],
        ] as [$name, $capacity]) {
            RestaurantTable::create(['name' => $name, 'capacity' => $capacity, 'status' => 'available']);
        }

        Setting::put('business_name', 'BeeHive Restobar');
        Setting::put('business_tagline', 'sweet bites, hot plates, happy nights');
        Setting::put('gcash_name', 'BeeHive Restobar');
        Setting::put('gcash_number', '09XX XXX XXXX');
        Setting::put('gcash_qr_base64', $this->qrPlaceholder());
        Setting::put('staff_pin_hash', Hash::make('staff123'));
        Setting::put('admin_pin_hash', Hash::make('admin123'));
    }

    private function svgDataUri(string $label, string $color): string
    {
        $safeLabel = htmlspecialchars($label, ENT_QUOTES, 'UTF-8');
        $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="800" height="500" viewBox="0 0 800 500">
  <rect width="800" height="500" rx="40" fill="$color"/>
  <circle cx="120" cy="95" r="70" fill="#fff7ed" opacity="0.35"/>
  <circle cx="680" cy="410" r="110" fill="#111827" opacity="0.12"/>
  <text x="50%" y="47%" dominant-baseline="middle" text-anchor="middle" font-family="Arial, sans-serif" font-size="54" font-weight="800" fill="#111827">🐝</text>
  <text x="50%" y="62%" dominant-baseline="middle" text-anchor="middle" font-family="Arial, sans-serif" font-size="34" font-weight="800" fill="#111827">$safeLabel</text>
</svg>
SVG;
        return 'data:image/svg+xml;base64,'.base64_encode($svg);
    }

    private function qrPlaceholder(): string
    {
        $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="500" height="500" viewBox="0 0 500 500">
  <rect width="500" height="500" fill="#ffffff"/>
  <rect x="40" y="40" width="120" height="120" fill="#111827"/>
  <rect x="70" y="70" width="60" height="60" fill="#ffffff"/>
  <rect x="340" y="40" width="120" height="120" fill="#111827"/>
  <rect x="370" y="70" width="60" height="60" fill="#ffffff"/>
  <rect x="40" y="340" width="120" height="120" fill="#111827"/>
  <rect x="70" y="370" width="60" height="60" fill="#ffffff"/>
  <g fill="#111827">
    <rect x="210" y="60" width="30" height="30"/><rect x="260" y="60" width="30" height="30"/><rect x="210" y="110" width="80" height="30"/>
    <rect x="190" y="190" width="30" height="30"/><rect x="240" y="190" width="80" height="30"/><rect x="360" y="190" width="30" height="30"/>
    <rect x="190" y="240" width="80" height="30"/><rect x="310" y="240" width="30" height="30"/><rect x="390" y="240" width="60" height="30"/>
    <rect x="190" y="300" width="30" height="30"/><rect x="260" y="300" width="30" height="30"/><rect x="340" y="300" width="110" height="30"/>
    <rect x="210" y="370" width="120" height="30"/><rect x="380" y="370" width="30" height="30"/><rect x="260" y="420" width="30" height="30"/><rect x="330" y="420" width="80" height="30"/>
  </g>
  <text x="250" y="275" text-anchor="middle" font-family="Arial" font-size="24" font-weight="800" fill="#f59e0b">GCash QR</text>
</svg>
SVG;
        return 'data:image/svg+xml;base64,'.base64_encode($svg);
    }
}
