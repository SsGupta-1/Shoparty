<?php

use Illuminate\Database\Seeder;
use App\Models\StaticPage;

class StaticPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $static = [
            ['type' => 4, 'title' => 'Terms & Conditions', 'description' => '<ol>
    <li>
    <p>All transactions will take place through the provided bank account after the booking has been placed as completed</p>
    </li>
    <li>
    <p>Charges applicable on the total bill are 10%</p>
    </li>
    <li>
    <p>Applicable bank fees will be covered by Shoparty</p>
    </li>
    <li>
        <p>Shoparty will generate offers, upgrades, and other complimentary services and add-ons for the customers.</p>
    </li>
    <li>
    <p>Appointments placed by the customers should be replied within the timeframe of 15 minutes</p>
    </li>
    <li>
    <p>The prices listed on the platform must apply the same rate of prices charged in the shop to avoid penalties. Chat windows are purely meant for appointment clarifications and <strong>should not</strong> be used to fix bookings.In case of such scenarios.Defaults on this policy will result in penalty charges of AED 30 which will be deducted from your bank account.</p>
    </li>
    <li>
    <p>In case of booking cancellations, the client has the right to cancel two (2) hours prior to the appointment. Failure to do so will result in the client&rsquo;s booking amount to be fully charged.</p>
    </li>
    <li>
    <p>Digital bills will be generated through the email</p>
    </li>
    <li>
    <p>We reserve the right to adjust the percentage charges on the total bill at any time upon fourteen (14) days prior notice.</p>
    </li>
    <li>
    <p>You are solely responsible for maintaining the confidentiality of your Account IDs and for any charges, damages, liabilities or losses incurred or suffered as a result of your failure to do so. You agree to immediately notify us of any unauthorized use of your Account or any other breach of security known to you.</p>
    </li>
    <li>
    <p>The Company reserves the right to remove or hide any content from the App, at its sole discretion.</p>
    </li>
    <li>
    <p>You may not copy, modify, or use any part of the Services, including, but not limited to, the name of the App, designs and logos, as these are protected by copyright laws.</p>
    </li>
    <li>
    <p>The Terms and Conditions can be amended in the future and we will endeavor to notify you of major changes but will not be liable for any failure to do so. Your continued use of the Services following any revision to these Terms and Conditions constitutes your complete and irrevocable acceptance of any and all such changes.</p>
    </li>
    <li>
    <p>Shoparty reserves the right, in its sole discretion, to terminate your Account if you violate these Terms and Conditions or for any reason or no reason at any time.</p>
    </li>
    <li>
    <p>Shoparty has no obligation to provide refunds or credits, but may grant them in rare circumstances, or to correct any system errors, in each case on Shoparty&#39;s sole discretion.</p>
    </li>
    <li>
    <p>Shoparty uses third-party payment processing services. By using these services, you agree to their terms of service as well.</p>
    </li>
    <li>
    <p>Your use of the services constitutes your acceptance of and agreement to all of the terms and conditions in these Terms and Conditions.</p>
    </li>
</ol>'],
            ['type' => 1, 'title' => 'About us', 'description' => '<p>Shoparty is the first app offering In-shop and Home services at the customers&rsquo; convenience. It is the only app where you can order from the comfort of your home through a simple click with no more hassles of phone calls.</p>

<p>This platform is perfectly made for your needs where it allows you to search for stores nearby, for the best offers from all the stores in town, with full transparency on their ratings and reviews.</p>

<p>Our notifications and timely reminders are perfect for your busy schedule.</p>

<p>You are just a click away from the chat or modify button and everything is sorted stress-free.</p>

<p>Your time is important to us, so we thought of saving the ATM machine/cash withdrawal hassles and replacing it with the perfect solution of using your card.</p>

<p>We aim to be your home from home where you always feel special and welcomed. Feel free to navigate through our platform to know more about the various services and don&rsquo;t hesitate to contact us for any query, suggestion, or feedback.</p>'],
        ];
  
        foreach ($static as $key => $value) {
            $Static_added = StaticPage::where(['type' => $value['type']])->first();
            if(empty($Static_added)){
                StaticPage::create($value);
            }
        }
    }
}
