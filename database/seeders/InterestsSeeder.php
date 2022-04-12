<?php

namespace Database\Seeders;

use App\Models\InterestingType;
use Illuminate\Database\Seeder;

class InterestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // IT
        // Sales/service management
        // Administrative/office-work
        // Tourism/Hospitality/HoReCa
        // Marketing/Advertising
        // Communications/Journalism/PR
        // Accounting/Bookkeeping/Cash register
        // Finance Management
        // Banking/credit
        // Education/training
        // Audit/Compliance
        // Healthcare/Pharmaceutical
        // Construction
        // Human Resources
        // Sports
        // Beauty
        // Procurement/Logistics/Courier
        // Production
        // Business/Management
        // Art/Design/Architecture
        // General/professional/Other services
        // NGO/Nonprofit
        // Insurance
        // Entertainment
        // Foreign language
        // Economics
        // Business Software Consultancy
        // Mechanical/Engineering
        // Retail business
        // Consultancy
        // Content writing
        // Security

        InterestingType::create(['name' => 'IT']);
        InterestingType::create(['name' => 'Sales/service management']);
        InterestingType::create(['name' => 'Administrative/office-work']);
        InterestingType::create(['name' => 'Tourism/Hospitality/HoReCa']);
        InterestingType::create(['name' => 'Marketing/Advertising']);
        InterestingType::create(['name' => 'Communications/Journalism/PR']);
        InterestingType::create(['name' => 'Accounting/Bookkeeping/Cash register']);
        InterestingType::create(['name' => 'Finance Management']);
        InterestingType::create(['name' => 'Banking/credit']);
        InterestingType::create(['name' => 'Audit/Compliance']);
        InterestingType::create(['name' => 'Education/training']);
        InterestingType::create(['name' => 'Healthcare/Pharmaceutical']);
        InterestingType::create(['name' => 'Construction']);
        InterestingType::create(['name' => 'Human Resources']);
        InterestingType::create(['name' => 'Sports']);
        InterestingType::create(['name' => 'Procurement/Logistics/Courier']);
        InterestingType::create(['name' => 'Beauty']);
        InterestingType::create(['name' => 'Production']);
        InterestingType::create(['name' => 'Business/Management']);
        InterestingType::create(['name' => 'Art/Design/Architecture']);
        InterestingType::create(['name' => 'General/professional/Other services']);
        InterestingType::create(['name' => 'NGO/Nonprofit']);
        InterestingType::create(['name' => 'Insurance']);
        InterestingType::create(['name' => 'Entertainment']);
        InterestingType::create(['name' => 'Foreign language']);
        InterestingType::create(['name' => 'Economics']);
        InterestingType::create(['name' => 'Business Software Consultancy']);
        InterestingType::create(['name' => 'Mechanical/Engineering']);
        InterestingType::create(['name' => 'Retail business']);
        InterestingType::create(['name' => 'Consultancy']);
        InterestingType::create(['name' => 'Content writing']);
        InterestingType::create(['name' => 'Security']);
    }
}
