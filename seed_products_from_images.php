<?php
/**
 * Seeds `product` rows for every image in assets/images/products/.
 * Re-run anytime; same filename keeps the same pid and updates the row.
 *
 * CLI: php seed_products_from_images.php
 * Browser: open once (protect/remove on production).
 */

declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '1');

chdir(__DIR__);
require __DIR__ . '/admin/db.php';

if (!isset($con) || !($con instanceof mysqli)) {
    fwrite(STDERR, "Database connection not available.\n");
    exit(1);
}

$productsDir = realpath(__DIR__ . '/assets/images/products');
if ($productsDir === false || !is_dir($productsDir)) {
    fwrite(STDERR, "Missing folder: assets/images/products\n");
    exit(1);
}

$allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp'];

function seed_pid(string $basename): string
{
    return hash('xxh3', 'electroshop_seed|' . strtolower($basename), false);
}

function esc(mysqli $con, string $s): string
{
    return mysqli_real_escape_string($con, $s);
}

function b64(mysqli $con, string $plain): string
{
    return esc($con, base64_encode($plain));
}

/**
 * Keys must be lowercase basenames (see callers).
 * Names match home.php deal carousel where noted.
 */
function seed_profile_for_file(string $lowerName): array
{
    $profiles = [
        '1_03862a58-5143-4be2-a71e-72ac6614c008.webp' => [
            'product_name' => '7-in-1 USB-C Multiport Hub (HDMI 4K, USB 3.0, PD 100W)',
            'brand_name' => 'PortLink',
            'category' => 'IT Accessories',
            'product_price' => '2799.00',
            'discount' => '12.00',
            'quantity' => 60,
            'short' => 'Compact aluminium hub: HDMI 4K@30Hz, three USB 3.0 ports, SD/TF readers, and pass-through USB-C charging for laptops and tablets.',
            'long' => '<p><strong>Ideal for</strong> hybrid work and travel—one cable from USB-C to desk productivity.</p><ul><li>HDMI 4K output</li><li>USB 3.0 up to 5 Gbps</li><li>Power Delivery passthrough (laptop charger stays connected)</li><li>Plug-and-play on Windows / macOS / ChromeOS</li></ul>',
        ],
        'ac2.jpg' => [
            'product_name' => 'Split Inverter Air Conditioner (1.5 Ton, 5 Star)',
            'brand_name' => 'CoolBreeze',
            'category' => 'Home Appliances',
            'product_price' => '38999.00',
            'discount' => '10.00',
            'quantity' => 18,
            'short' => 'Energy-efficient inverter compressor, copper condenser, stabilizer-free operation within rated voltage band, and sleep mode.',
            'long' => '<p><strong>Installation</strong> by brand-authorised technician (typical lead time communicated at purchase).</p><ul><li>1.5 ton suitable for mid-sized rooms</li><li>PM 2.5 filter option (model-dependent)</li><li>Quiet indoor unit operation</li><li>Manufacturer warranty as per card in box</li></ul>',
        ],
        'airpod.jpeg' => [
            'product_name' => 'True Wireless Earbuds with ANC & ENC (IPX5)',
            'brand_name' => 'SoundArc',
            'category' => 'Audio',
            'product_price' => '7999.00',
            'discount' => '18.00',
            'quantity' => 85,
            'short' => 'Hybrid active noise cancellation, transparency mode, low-latency gaming mode, and up to 28 h total playtime with charging case.',
            'long' => '<p><strong>In the box:</strong> earbuds, charging case, USB-C cable, three pairs of eartips.</p><ul><li>Bluetooth 5.3 multipoint (device-dependent)</li><li>Touch controls &amp; voice assistant</li><li>Fast charge: ~10 min for hours of playback</li></ul>',
        ],
        'bike.webp' => [
            'product_name' => 'Electric Commuter Scooter (Foldable, 250W Hub Motor)',
            'brand_name' => 'VoltRide',
            'category' => 'Electric Mobility',
            'product_price' => '72499.00',
            'discount' => '8.00',
            'quantity' => 12,
            'short' => 'Street-legal where permitted: drum/disc brakes, LED lights, removable battery option on select trims, and compact fold for boot storage.',
            'long' => '<p><strong>Important:</strong> Follow local registration and helmet laws.</p><ul><li>Typical range 60–75 km (eco mode, rider weight &amp; terrain dependent)</li><li>LCD display with speed &amp; battery</li><li>Manufacturer warranty on motor &amp; controller</li></ul>',
        ],
        'bord.jpg' => [
            'product_name' => 'Premium Bamboo Cutting Board with Juice Groove (Medium)',
            'brand_name' => 'KitchenCraft',
            'category' => 'Kitchen & Dining',
            'product_price' => '899.00',
            'discount' => '15.00',
            'quantity' => 200,
            'short' => 'Naturally antimicrobial bamboo surface, reversible design, and routed groove to catch liquids—gentle on knife edges.',
            'long' => '<p><strong>Care:</strong> Hand wash and oil occasionally with food-safe mineral oil.</p><ul><li>Approx. 38 × 28 cm cutting area</li><li>Non-slip feet on select batches</li></ul>',
        ],
        'bp monitor.jpeg' => [
            'product_name' => 'Digital Upper Arm Blood Pressure Monitor (WHO Indicator)',
            'brand_name' => 'MedCheck',
            'category' => 'Health & Wellness',
            'product_price' => '1699.00',
            'discount' => '14.00',
            'quantity' => 70,
            'short' => 'Clinically validated algorithm, large cuff fit (22–42 cm), irregular heartbeat detection, and memory for two users.',
            'long' => '<p><strong>Note:</strong> For wellness tracking only—not a substitute for professional diagnosis.</p><ul><li>Battery-operated (batteries included where stated on box)</li><li>Travel pouch included</li></ul>',
        ],
        'cabels.webp' => [
            'product_name' => 'Certified HDMI 2.0 + Cat6 Ethernet Cable Combo Pack',
            'brand_name' => 'LinkPro',
            'category' => 'IT Accessories',
            'product_price' => '1299.00',
            'discount' => '11.00',
            'quantity' => 120,
            'short' => '2 m HDMI supporting 4K HDR where sources allow, plus snagless RJ45 patch lead for stable wired networking.',
            'long' => '<ul><li>Gold-plated connectors</li><li>Braided sleeve on HDMI where pictured</li><li>Ideal for consoles, PCs, and smart TVs</li></ul>',
        ],
        'camera.jpg' => [
            'product_name' => 'APS-C Mirrorless Camera with 18–55 mm Kit Lens',
            'brand_name' => 'OptixLab',
            'category' => 'Cameras',
            'product_price' => '52999.00',
            'discount' => '7.00',
            'quantity' => 22,
            'short' => '24 MP sensor, fast hybrid AF, 4K video (crop/settings dependent), tilting touchscreen, and Wi-Fi image transfer.',
            'long' => '<p><strong>Kit includes:</strong> body, kit zoom, battery, charger, strap.</p><ul><li>Interchangeable lens ecosystem</li><li>Manufacturer warranty; register online where required</li></ul>',
        ],
        'cctv.webp' => [
            'product_name' => '4-Ch HD DVR CCTV Kit (4 Bullet Cameras, Night Vision)',
            'brand_name' => 'SecureView',
            'category' => 'Security',
            'product_price' => '8999.00',
            'discount' => '13.00',
            'quantity' => 35,
            'short' => 'Outdoor-rated bullets with IR night vision, DVR with HDD bay, mobile app viewing, and motion-detection alerts.',
            'long' => '<p><strong>Install:</strong> Professional cabling recommended for long runs.</p><ul><li>Weatherproof housings</li><li>Recording schedule &amp; backup options</li></ul>',
        ],
        'charger.jpeg' => [
            'product_name' => '33 W USB-C PD GaN Fast Charger with Cable',
            'brand_name' => 'ChargeMax',
            'category' => 'Mobile Accessories',
            'product_price' => '1299.00',
            'discount' => '16.00',
            'quantity' => 180,
            'short' => 'Cooler-running GaN design; supports PD/PPS profiles common on phones and tablets; includes 1 m USB-C cable.',
            'long' => '<ul><li>BIS-compliant Indian plug</li><li>Multi-layer safety (OVP, OCP, OTP)</li><li>Compact for travel</li></ul>',
        ],
        'cover.jpeg' => [
            'product_name' => 'Hybrid Shockproof Phone Case (Clear Back, Air Cushion)',
            'brand_name' => 'ShieldSkin',
            'category' => 'Mobile Accessories',
            'product_price' => '449.00',
            'discount' => '22.00',
            'quantity' => 300,
            'short' => 'Raised lip for camera &amp; screen, tactile buttons, yellowing-resistant TPU bumper—model matched to current bestsellers.',
            'long' => '<p><strong>Compatibility:</strong> Confirm exact phone model before checkout.</p><ul><li>Military-style drop testing claims vary by batch</li><li>Wireless charging compatible on most models</li></ul>',
        ],
        'cpu.jpeg' => [
            'product_name' => 'Latest-Gen Octa-Core Desktop Processor (Box Pack, Cooler Included)',
            'brand_name' => 'ComputeCore',
            'category' => 'PC Components',
            'product_price' => '22499.00',
            'discount' => '6.00',
            'quantity' => 40,
            'short' => 'High IPC architecture for gaming &amp; creator workloads; PCIe Gen support as per series; warranty via authorised service.',
            'long' => '<ul><li>Check motherboard BIOS compatibility before purchase</li><li>Thermal paste pre-applied on bundled cooler where applicable</li><li>Verify PSU headroom for GPU pairing</li></ul>',
        ],
        'electroshop.png' => [
            'product_name' => 'ElectroShop Branded Reusable Shopping Bag (Large)',
            'brand_name' => 'ElectroShop',
            'category' => 'Merchandise',
            'product_price' => '199.00',
            'discount' => '25.00',
            'quantity' => 500,
            'short' => 'Heavy-duty non-woven tote with long handles—carry laptops, groceries, or cart hauls from our store.',
            'long' => '<p>Show your ElectroShop love at checkout lines and campus.</p><ul><li>Foldable &amp; washable</li><li>Capacity suited for daily errands</li></ul>',
        ],
        'exide.jpeg' => [
            'product_name' => 'Exide Automotive Battery (Flooded Lead Acid, Popular Car Segment)',
            'brand_name' => 'Exide',
            'category' => 'Automotive',
            'product_price' => '5499.00',
            'discount' => '9.00',
            'quantity' => 45,
            'short' => 'Reliable cranking amps for hatchbacks &amp; sedans; consult fitment chart for exact AH/CC ratings.',
            'long' => '<p><strong>Important:</strong> Professional installation &amp; old-battery exchange as per policy.</p><ul><li>Pro-rata warranty per manufacturer card</li><li>Handle with care—acid hazard</li></ul>',
        ],
        'fan.jpg' => [
            'product_name' => 'High Speed Ceiling Fan (1200 mm, Anti-Dust Coating)',
            'brand_name' => 'AirFlow',
            'category' => 'Home Appliances',
            'product_price' => '3199.00',
            'discount' => '12.00',
            'quantity' => 55,
            'short' => 'Energy-efficient motor, balanced blades for low wobble, dual-tone colour options as per batch.',
            'long' => '<ul><li>2-year warranty typical on motor</li><li>Suitable for medium rooms</li><li>Installation charges may apply locally</li></ul>',
        ],
        'freeg.webp' => [
            'product_name' => 'Direct Cool Single Door Refrigerator (190 L, 3 Star)',
            'brand_name' => 'FreshNest',
            'category' => 'Home Appliances',
            'product_price' => '15490.00',
            'discount' => '11.00',
            'quantity' => 25,
            'short' => 'Stabiliser-free operation within rated range, toughened glass shelves, large vegetable basket, and manual defrost.',
            'long' => '<ul><li>Door orientation reversible on many SKUs—confirm store listing</li><li>Ideal for compact kitchens &amp; PG setups</li></ul>',
        ],
        'glass.webp' => [
            'product_name' => 'Tempered Glass Screen Protector (9H, Oleophobic Coating)',
            'brand_name' => 'CrystalGuard',
            'category' => 'Mobile Accessories',
            'product_price' => '299.00',
            'discount' => '30.00',
            'quantity' => 400,
            'short' => 'Case-friendly cutouts, bubble-free adhesive kit included—match phone model before buying.',
            'long' => '<ul><li>Touch sensitivity retained</li><li>Includes wipes &amp; alignment frame where pictured</li></ul>',
        ],
        'graphics card.jpg' => [
            'product_name' => '8 GB GDDR6 Gaming Graphics Card (PCIe 4.0, Dual Fan)',
            'brand_name' => 'PixelForge',
            'category' => 'PC Components',
            'product_price' => '32999.00',
            'discount' => '8.00',
            'quantity' => 28,
            'short' => '1080p/1440p gaming in modern titles; DLSS/FSR where supported; factory OC profiles via software.',
            'long' => '<ul><li>Check case length &amp; PSU wattage / PCIe power connectors</li><li>Driver updates from GPU vendor site</li></ul>',
        ],
        'iron.jpg' => [
            'product_name' => 'Steam Iron with Ceramic Soleplate (1600 W)',
            'brand_name' => 'PressEase',
            'category' => 'Home Appliances',
            'product_price' => '1499.00',
            'discount' => '17.00',
            'quantity' => 90,
            'short' => 'Vertical steam burst, anti-drip, self-clean function, and precision tip for collars.',
            'long' => '<ul><li>360° swivel cord</li><li>Water spray &amp; variable steam</li><li>BIS plug &amp; safety shut-off where equipped</li></ul>',
        ],
        'katel.jpg' => [
            'product_name' => 'Stainless Steel Electric Kettle (1.7 L, Auto Shut-Off)',
            'brand_name' => 'BoilQuick',
            'category' => 'Kitchen Appliances',
            'product_price' => '1199.00',
            'discount' => '14.00',
            'quantity' => 110,
            'short' => 'Concealed heating element, boil-dry protection, 360° cordless base, wide mouth for cleaning.',
            'long' => '<ul><li>Perfect for tea, instant noodles &amp; baby formula prep</li><li>Cool-touch handle</li></ul>',
        ],
        'keybord.jpeg' => [
            'product_name' => 'Wireless Mechanical Keyboard (Hot-Swap, RGB)',
            'brand_name' => 'KeyForge',
            'category' => 'IT Accessories',
            'product_price' => '3499.00',
            'discount' => '13.00',
            'quantity' => 65,
            'short' => 'Tactile switches (batch-dependent), USB-C charging, multi-device Bluetooth, Mac &amp; Windows legends.',
            'long' => '<ul><li>Software remapping on Windows</li><li>Padded wrist rest optional per SKU</li></ul>',
        ],
        'laptop.jpeg' => [
            'product_name' => '15.6" FHD Thin & Light Laptop (16 GB RAM, 512 GB SSD)',
            'brand_name' => 'NovaBook',
            'category' => 'Laptops',
            'product_price' => '56990.00',
            'discount' => '10.00',
            'quantity' => 30,
            'short' => 'Latest-gen efficiency cores, Wi-Fi 6, backlit keyboard, fast SSD, ideal for study &amp; office workloads.',
            'long' => '<ul><li>Ports: USB-C, USB-A, HDMI, audio jack (exact layout may vary)</li><li>Pre-installed OS with recovery partition</li><li>1-year carry-in warranty typical</li></ul>',
        ],
        'mac.jpeg' => [
            'product_name' => 'MACBOOK AIR 1',
            'brand_name' => 'Apple',
            'category' => 'Laptops',
            'product_price' => '114900.00',
            'discount' => '5.00',
            'quantity' => 15,
            'short' => 'Fanless silent design, all-day battery, brilliant Liquid Retina display, and Apple silicon performance for work &amp; creativity.',
            'long' => '<p><strong>Note:</strong> Product name matches storefront “Deal of the Day” filter.</p><ul><li>Exact chip generation &amp; RAM per invoice</li><li>Register for Apple warranty</li><li>Colour availability varies</li></ul>',
        ],
        'mixer.jpeg' => [
            'product_name' => '550 W Mixer Grinder with 3 Stainless Steel Jars',
            'brand_name' => 'BlendMaster',
            'category' => 'Kitchen Appliances',
            'product_price' => '4499.00',
            'discount' => '12.00',
            'quantity' => 48,
            'short' => 'Overload protector, flow breakers for smooth grinding, vacuum feet for stability.',
            'long' => '<ul><li>Wet grinding, dry spices &amp; chutney jars</li><li>2-year motor warranty typical</li></ul>',
        ],
        'mobile battery.webp' => [
            'product_name' => 'High-Capacity Replacement Smartphone Battery (IC Protected)',
            'brand_name' => 'PowerCell',
            'category' => 'Mobile Accessories',
            'product_price' => '2199.00',
            'discount' => '10.00',
            'quantity' => 75,
            'short' => 'Match phone model exactly—Li-ion with PCM protection; professional installation recommended.',
            'long' => '<p><strong>Safety:</strong> Do not puncture or expose to heat.</p><ul><li>Typical cycle life per OEM guidelines</li></ul>',
        ],
        'mobile cabel.jpeg' => [
            'product_name' => 'Braided USB-A to USB-C Fast Charging Cable (2 m, 3A)',
            'brand_name' => 'CableKind',
            'category' => 'Mobile Accessories',
            'product_price' => '599.00',
            'discount' => '20.00',
            'quantity' => 250,
            'short' => 'Reinforced strain relief, high-speed data support where USB 2.0/3.x applies—tangle-resistant weave.',
            'long' => '<ul><li>Ideal with 18–33 W chargers</li><li>Colour may vary by batch</li></ul>',
        ],
        'monitor.jpeg' => [
            'product_name' => '27" QHD IPS Monitor (75 Hz, AMD FreeSync)',
            'brand_name' => 'ViewCraft',
            'category' => 'Monitors',
            'product_price' => '18999.00',
            'discount' => '9.00',
            'quantity' => 34,
            'short' => 'sRGB coverage suited for work &amp; casual gaming; slim bezels; tilt-adjust stand (see SKU for VESA).',
            'long' => '<ul><li>HDMI + DisplayPort inputs typical</li><li>Low blue light &amp; flicker-safe modes</li></ul>',
        ],
        'monitor1.jpg' => [
            'product_name' => '24" FHD IPS Office Monitor (75 Hz, Frameless)',
            'brand_name' => 'ViewCraft',
            'category' => 'Monitors',
            'product_price' => '11299.00',
            'discount' => '10.00',
            'quantity' => 42,
            'short' => 'Crisp text for spreadsheets &amp; coding; HDMI &amp; VGA on select batches; eye-care modes.',
            'long' => '<ul><li>Compact footprint for dual-monitor setups</li><li>Includes appropriate video cable in box</li></ul>',
        ],
        'pendrive.jpeg' => [
            'product_name' => '128 GB USB 3.2 Gen 1 Metal Flash Drive',
            'brand_name' => 'DataStick',
            'category' => 'IT Accessories',
            'product_price' => '899.00',
            'discount' => '18.00',
            'quantity' => 200,
            'short' => 'Capless sliding design, keyring hole, read speeds typical of Gen 1 flash—great for backups &amp; media.',
            'long' => '<ul><li>Backward compatible with USB 2.0 ports</li><li>5-year limited warranty typical</li></ul>',
        ],
        'phone.jpeg' => [
            'product_name' => '5G Smartphone (128 GB Storage, 50 MP Triple Camera)',
            'brand_name' => 'PulseMobile',
            'category' => 'Mobiles',
            'product_price' => '26999.00',
            'discount' => '11.00',
            'quantity' => 55,
            'short' => '120 Hz FHD+ display, large battery with fast charge, clean UI with promised OS updates window.',
            'long' => '<ul><li>Dual SIM + microSD on supported variants</li><li>In-box protective case &amp; cable</li></ul>',
        ],
        'printer.jpeg' => [
            'product_name' => 'Wi-Fi Ink Tank Colour Printer (Scan & Copy)',
            'brand_name' => 'PrintWell',
            'category' => 'Office Electronics',
            'product_price' => '15499.00',
            'discount' => '10.00',
            'quantity' => 28,
            'short' => 'Ultra-low cost per page with refillable tanks; mobile printing apps; borderless photos up to 4×6".',
            'long' => '<ul><li>Initial ink set in box</li><li>Recommended monthly duty cycle in manual</li></ul>',
        ],
        'projector.jpeg' => [
            'product_name' => 'Full HD LED Projector (3500 LM Class, Wireless Display)',
            'brand_name' => 'CineBeam',
            'category' => 'Home Entertainment',
            'product_price' => '28999.00',
            'discount' => '12.00',
            'quantity' => 20,
            'short' => 'Big-screen movies &amp; sports; keystone correction; built-in speaker; HDMI/USB inputs.',
            'long' => '<ul><li>Ambient light affects perceived brightness</li><li>Tripod / ceiling mount optional</li></ul>',
        ],
        'quotes.svg' => [
            'product_name' => 'Minimal Typography Wall Art Trio (Unframed Prints)',
            'brand_name' => 'Studio Line',
            'category' => 'Lifestyle & Decor',
            'product_price' => '749.00',
            'discount' => '20.00',
            'quantity' => 150,
            'short' => 'Three coordinated monochrome quote prints on matte art paper—perfect for desks, studios, or gallery walls.',
            'long' => '<p><strong>What you get</strong></p><p>Three matching A4-sized prints featuring clean typography. Ships rolled in a protective tube.</p><ul><li>Matte 210 GSM poster paper</li><li>Easy to frame in standard A4 frames</li></ul><p><em>Frames not included.</em></p>',
        ],
        'router.jpg' => [
            'product_name' => 'Wi-Fi 6 AX3000 Dual Band Gigabit Router',
            'brand_name' => 'NetStream',
            'category' => 'Networking',
            'product_price' => '2499.00',
            'discount' => '15.00',
            'quantity' => 70,
            'short' => 'OFDMA &amp; MU-MIMO for busy homes; WPA3; easy app setup; four gigabit LAN ports.',
            'long' => '<ul><li>ISP fibre modem required for WAN</li><li>Wall-mount slots on base</li></ul>',
        ],
        's25.jpeg' => [
            'product_name' => 'Samsung Galaxy S25',
            'brand_name' => 'Samsung',
            'category' => 'Mobiles',
            'product_price' => '84999.00',
            'discount' => '8.00',
            'quantity' => 40,
            'short' => 'Flagship AI photography, brightest display in series, all-day battery &amp; ultra-fast charging stack.',
            'long' => '<p><strong>Note:</strong> Product name matches storefront “Deal of the Day” filter.</p><ul><li>Regional bands &amp; RAM/storage per invoice</li><li>Register Samsung Care+ if purchased</li><li>In-box cable &amp; SIM tool</li></ul>',
        ],
        'trimmer.webp' => [
            'product_name' => 'Cordless Beard Trimmer with USB Fast Charge (20 Length Settings)',
            'brand_name' => 'TrimPro',
            'category' => 'Personal Care',
            'product_price' => '1599.00',
            'discount' => '16.00',
            'quantity' => 130,
            'short' => 'Skin-friendly blades, washable head, travel lock, LED battery gauge on premium trims.',
            'long' => '<ul><li>90+ minutes runtime typical</li><li>Guide combs included</li></ul>',
        ],
        'wall clock.jpg' => [
            'product_name' => 'Silent Sweep Wall Clock (30 cm, Minimal Dial)',
            'brand_name' => 'TimeHue',
            'category' => 'Lifestyle & Decor',
            'product_price' => '1299.00',
            'discount' => '14.00',
            'quantity' => 95,
            'short' => 'Non-ticking quartz movement, clear numerals, lightweight body—living room &amp; office friendly.',
            'long' => '<ul><li>Single AA battery (not always included—check box)</li><li>Easy wall mounting hook</li></ul>',
        ],
        'washing macine.jpeg' => [
            'product_name' => 'Fully Automatic Front Load Washer (7 kg, Inverter)',
            'brand_name' => 'WashMate',
            'category' => 'Home Appliances',
            'product_price' => '28990.00',
            'discount' => '10.00',
            'quantity' => 16,
            'short' => 'Steam hygiene option on select programs, inverter motor for quieter spins, child lock.',
            'long' => '<ul><li>Installation &amp; demo by authorised agent</li><li>Inlet hose &amp; drain accessories in box</li></ul>',
        ],
        'watch-1.jpg' => [
            'product_name' => 'Classic Analog Stainless Steel Watch (Water Resistant 5 ATM)',
            'brand_name' => 'ChronoMark',
            'category' => 'Wearables',
            'product_price' => '4999.00',
            'discount' => '14.00',
            'quantity' => 60,
            'short' => 'Mineral glass, luminous hands, date window, bracelet with push-button deployant clasp.',
            'long' => '<ul><li>2-year movement warranty typical</li><li>Avoid hot water despite WR rating</li></ul>',
        ],
        'watch-2.jpg' => [
            'product_name' => 'Sports Chronograph Watch with Silicone Strap',
            'brand_name' => 'ChronoMark',
            'category' => 'Wearables',
            'product_price' => '3499.00',
            'discount' => '17.00',
            'quantity' => 72,
            'short' => 'Stopwatch subdials, rugged case finish, breathable strap—gym to weekend wear.',
            'long' => '<ul><li>Battery quartz movement</li><li>Scratch-resistant mineral crystal</li></ul>',
        ],
        'watch.svg' => [
            'product_name' => 'PulseFit BT Calling Smartwatch (1.83" HD)',
            'brand_name' => 'ElectroNova',
            'category' => 'Smart Wearables',
            'product_price' => '3499.00',
            'discount' => '15.00',
            'quantity' => 80,
            'short' => 'Bluetooth calling, SpO₂ & heart rate monitoring, 100+ sports modes, and up to 7-day battery life.',
            'long' => '<p><strong>Overview</strong></p><p>Versatile everyday smartwatch with crisp display and comprehensive health metrics.</p><ul><li>1.83-inch HD colour display</li><li>Bluetooth calling with speaker &amp; mic</li><li>Heart rate, SpO₂, sleep tracking</li><li>IP68 (lab-rated)</li></ul>',
        ],
        'welding macin.jpeg' => [
            'product_name' => 'ARC Welding Inverter (200 A, IGBT)',
            'brand_name' => 'SparkWeld',
            'category' => 'Tools & Hardware',
            'product_price' => '8499.00',
            'discount' => '9.00',
            'quantity' => 25,
            'short' => 'Portable MMA inverter; hot start &amp; anti-stick; fan cooled—includes electrode holder &amp; earth clamp.',
            'long' => '<p><strong>Safety:</strong> Welding helmet &amp; gloves mandatory—sold separately unless bundled.</p><ul><li>Generator-compatible within voltage limits</li></ul>',
        ],
        'wire cabels.png' => [
            'product_name' => 'Copper Core Electrical Wire Bundle (House Wiring Kit)',
            'brand_name' => 'SafeWire',
            'category' => 'Electricals',
            'product_price' => '1299.00',
            'discount' => '11.00',
            'quantity' => 85,
            'short' => 'PVC insulated FR-grade wires in common gauges for lighting &amp; socket circuits—electrician installation only.',
            'long' => '<p><strong>Disclaimer:</strong> National electrical code &amp; licensed electrician required.</p><ul><li>Lengths bundled as per retail pack</li></ul>',
        ],
    ];

    if (isset($profiles[$lowerName])) {
        return $profiles[$lowerName];
    }

    $stem = preg_replace('/\.[^.]+$/', '', $lowerName);
    $stem = str_replace(['_', '-'], ' ', $stem);
    $title = $stem === '' ? 'Product' : ucwords(trim($stem));
    $n = crc32($lowerName);

    return [
        'product_name' => $title,
        'brand_name' => 'ElectroShop Select',
        'category' => 'Electronics & Accessories',
        'product_price' => number_format(1499 + ($n % 8500), 2, '.', ''),
        'discount' => number_format(5 + ($n % 21), 2, '.', ''),
        'quantity' => 10 + ($n % 90),
        'short' => 'Quality-checked listing with clear imagery. See long description for highlights and what is included in the box.',
        'long' => '<p><strong>Product details</strong></p><p>Auto-catalogued from <code>assets/images/products</code>. Refine details in admin if needed.</p><ul><li>Secure packaging</li><li>Warranty as per brand policy</li></ul>',
    ];
}

$files = scandir($productsDir) ?: [];
$inserted = 0;
$updated = 0;

foreach ($files as $file) {
    if ($file === '.' || $file === '..') {
        continue;
    }
    $path = $productsDir . DIRECTORY_SEPARATOR . $file;
    if (!is_file($path)) {
        continue;
    }
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedExt, true)) {
        continue;
    }

    $lower = strtolower($file);
    $pid = seed_pid($file);
    $p = seed_profile_for_file($lower);

    $imgsJson = esc($con, json_encode([$file], JSON_UNESCAPED_SLASHES));

    $check = mysqli_query($con, "SELECT `sl` FROM `product` WHERE `pid` = '" . esc($con, $pid) . "' LIMIT 1;");
    $exists = $check && mysqli_num_rows($check) > 0;

    $sql = $exists
        ? "UPDATE `product` SET
            `product_name` = '" . esc($con, $p['product_name']) . "',
            `brand_name` = '" . esc($con, $p['brand_name']) . "',
            `short_des` = '" . b64($con, $p['short']) . "',
            `long_des` = '" . b64($con, $p['long']) . "',
            `imgs_link` = '" . $imgsJson . "',
            `product_price` = '" . esc($con, $p['product_price']) . "',
            `quantity` = " . (int) $p['quantity'] . ",
            `discount` = '" . esc($con, $p['discount']) . "',
            `category` = '" . esc($con, $p['category']) . "'
            WHERE `pid` = '" . esc($con, $pid) . "';"
        : "INSERT INTO `product` (`pid`, `product_name`, `brand_name`, `short_des`, `long_des`, `imgs_link`, `product_price`, `quantity`, `discount`, `category`)
            VALUES (
            '" . esc($con, $pid) . "',
            '" . esc($con, $p['product_name']) . "',
            '" . esc($con, $p['brand_name']) . "',
            '" . b64($con, $p['short']) . "',
            '" . b64($con, $p['long']) . "',
            '" . $imgsJson . "',
            '" . esc($con, $p['product_price']) . "',
            " . (int) $p['quantity'] . ",
            '" . esc($con, $p['discount']) . "',
            '" . esc($con, $p['category']) . "'
            );";

    if (!mysqli_query($con, $sql)) {
        fwrite(STDERR, "SQL error for {$file}: " . mysqli_error($con) . "\n");
        continue;
    }

    if ($exists) {
        $updated++;
    } else {
        $inserted++;
    }

    if (php_sapi_name() !== 'cli') {
        echo htmlspecialchars($file, ENT_QUOTES, 'UTF-8') . ($exists ? " updated\n" : " inserted\n");
    }
}

$msg = "Done. Inserted: {$inserted}, Updated: {$updated}. Folder: {$productsDir}\n";
if (php_sapi_name() === 'cli') {
    echo $msg;
} else {
    header('Content-Type: text/plain; charset=utf-8');
    echo $msg;
}
