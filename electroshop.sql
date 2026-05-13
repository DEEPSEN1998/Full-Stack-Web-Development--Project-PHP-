-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 13, 2026 at 10:14 AM
-- Server version: 12.1.2-MariaDB
-- PHP Version: 8.5.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `electroshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `sl` int(11) NOT NULL,
  `cid` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `join_date` text NOT NULL,
  `cart` text DEFAULT NULL,
  `wishlist` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`sl`, `cid`, `email`, `phone`, `full_name`, `password`, `address`, `join_date`, `cart`, `wishlist`) VALUES
(1, '3a7fa8eba7490cae', 'dsen6072@gmail.com', '9064094115', 'Deep', 'ebc94b4df845420a820bc5ae52e58e4e16187462fe53cf8504959adc44b6e9cd', '16/7 ashokenagar', '1778659634', '{\"391a94b97f2782f6\":1,\"84dccdb397c3fdf9\":1,\"d0e7c29fbc779323\":1,\"b41f57ca17615652\":1}', '{\"84dccdb397c3fdf9\":1,\"d0e7c29fbc779323\":1,\"b41f57ca17615652\":1}');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `sl` int(11) NOT NULL,
  `pid` text NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `brand_name` varchar(255) DEFAULT NULL,
  `short_des` text DEFAULT NULL,
  `long_des` text DEFAULT NULL,
  `imgs_link` text DEFAULT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `quantity` int(11) DEFAULT 0,
  `discount` decimal(5,2) DEFAULT 0.00,
  `category` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`sl`, `pid`, `product_name`, `brand_name`, `short_des`, `long_des`, `imgs_link`, `product_price`, `quantity`, `discount`, `category`) VALUES
(1, 'c70c3a2fccb4bf9f', '7-in-1 USB-C Multiport Hub (HDMI 4K, USB 3.0, PD 100W)', 'PortLink', 'Q29tcGFjdCBhbHVtaW5pdW0gaHViOiBIRE1JIDRLQDMwSHosIHRocmVlIFVTQiAzLjAgcG9ydHMsIFNEL1RGIHJlYWRlcnMsIGFuZCBwYXNzLXRocm91Z2ggVVNCLUMgY2hhcmdpbmcgZm9yIGxhcHRvcHMgYW5kIHRhYmxldHMu', 'PHA+PHN0cm9uZz5JZGVhbCBmb3I8L3N0cm9uZz4gaHlicmlkIHdvcmsgYW5kIHRyYXZlbOKAlG9uZSBjYWJsZSBmcm9tIFVTQi1DIHRvIGRlc2sgcHJvZHVjdGl2aXR5LjwvcD48dWw+PGxpPkhETUkgNEsgb3V0cHV0PC9saT48bGk+VVNCIDMuMCB1cCB0byA1IEdicHM8L2xpPjxsaT5Qb3dlciBEZWxpdmVyeSBwYXNzdGhyb3VnaCAobGFwdG9wIGNoYXJnZXIgc3RheXMgY29ubmVjdGVkKTwvbGk+PGxpPlBsdWctYW5kLXBsYXkgb24gV2luZG93cyAvIG1hY09TIC8gQ2hyb21lT1M8L2xpPjwvdWw+', '[\"1_03862a58-5143-4be2-a71e-72ac6614c008.webp\"]', 2799.00, 60, 12.00, 'IT Accessories'),
(2, '84dccdb397c3fdf9', 'Exide Automotive Battery (Flooded Lead Acid, Popular Car Segment)', 'Exide', 'UmVsaWFibGUgY3JhbmtpbmcgYW1wcyBmb3IgaGF0Y2hiYWNrcyAmYW1wOyBzZWRhbnM7IGNvbnN1bHQgZml0bWVudCBjaGFydCBmb3IgZXhhY3QgQUgvQ0MgcmF0aW5ncy4=', 'PHA+PHN0cm9uZz5JbXBvcnRhbnQ6PC9zdHJvbmc+IFByb2Zlc3Npb25hbCBpbnN0YWxsYXRpb24gJmFtcDsgb2xkLWJhdHRlcnkgZXhjaGFuZ2UgYXMgcGVyIHBvbGljeS48L3A+PHVsPjxsaT5Qcm8tcmF0YSB3YXJyYW50eSBwZXIgbWFudWZhY3R1cmVyIGNhcmQ8L2xpPjxsaT5IYW5kbGUgd2l0aCBjYXJl4oCUYWNpZCBoYXphcmQ8L2xpPjwvdWw+', '[\"Exide.jpeg\"]', 5499.00, 45, 9.00, 'Automotive'),
(3, 'd0e7c29fbc779323', 'Split Inverter Air Conditioner (1.5 Ton, 5 Star)', 'CoolBreeze', 'RW5lcmd5LWVmZmljaWVudCBpbnZlcnRlciBjb21wcmVzc29yLCBjb3BwZXIgY29uZGVuc2VyLCBzdGFiaWxpemVyLWZyZWUgb3BlcmF0aW9uIHdpdGhpbiByYXRlZCB2b2x0YWdlIGJhbmQsIGFuZCBzbGVlcCBtb2RlLg==', 'PHA+PHN0cm9uZz5JbnN0YWxsYXRpb248L3N0cm9uZz4gYnkgYnJhbmQtYXV0aG9yaXNlZCB0ZWNobmljaWFuICh0eXBpY2FsIGxlYWQgdGltZSBjb21tdW5pY2F0ZWQgYXQgcHVyY2hhc2UpLjwvcD48dWw+PGxpPjEuNSB0b24gc3VpdGFibGUgZm9yIG1pZC1zaXplZCByb29tczwvbGk+PGxpPlBNIDIuNSBmaWx0ZXIgb3B0aW9uIChtb2RlbC1kZXBlbmRlbnQpPC9saT48bGk+UXVpZXQgaW5kb29yIHVuaXQgb3BlcmF0aW9uPC9saT48bGk+TWFudWZhY3R1cmVyIHdhcnJhbnR5IGFzIHBlciBjYXJkIGluIGJveDwvbGk+PC91bD4=', '[\"ac2.jpg\"]', 38999.00, 18, 10.00, 'Home Appliances'),
(4, '8aa3389913f1ecaf', 'True Wireless Earbuds with ANC & ENC (IPX5)', 'SoundArc', 'SHlicmlkIGFjdGl2ZSBub2lzZSBjYW5jZWxsYXRpb24sIHRyYW5zcGFyZW5jeSBtb2RlLCBsb3ctbGF0ZW5jeSBnYW1pbmcgbW9kZSwgYW5kIHVwIHRvIDI4IGggdG90YWwgcGxheXRpbWUgd2l0aCBjaGFyZ2luZyBjYXNlLg==', 'PHA+PHN0cm9uZz5JbiB0aGUgYm94Ojwvc3Ryb25nPiBlYXJidWRzLCBjaGFyZ2luZyBjYXNlLCBVU0ItQyBjYWJsZSwgdGhyZWUgcGFpcnMgb2YgZWFydGlwcy48L3A+PHVsPjxsaT5CbHVldG9vdGggNS4zIG11bHRpcG9pbnQgKGRldmljZS1kZXBlbmRlbnQpPC9saT48bGk+VG91Y2ggY29udHJvbHMgJmFtcDsgdm9pY2UgYXNzaXN0YW50PC9saT48bGk+RmFzdCBjaGFyZ2U6IH4xMCBtaW4gZm9yIGhvdXJzIG9mIHBsYXliYWNrPC9saT48L3VsPg==', '[\"airpod.jpeg\"]', 7999.00, 85, 18.00, 'Audio'),
(5, '3fd325526f70aa1d', 'Electric Commuter Scooter (Foldable, 250W Hub Motor)', 'VoltRide', 'U3RyZWV0LWxlZ2FsIHdoZXJlIHBlcm1pdHRlZDogZHJ1bS9kaXNjIGJyYWtlcywgTEVEIGxpZ2h0cywgcmVtb3ZhYmxlIGJhdHRlcnkgb3B0aW9uIG9uIHNlbGVjdCB0cmltcywgYW5kIGNvbXBhY3QgZm9sZCBmb3IgYm9vdCBzdG9yYWdlLg==', 'PHA+PHN0cm9uZz5JbXBvcnRhbnQ6PC9zdHJvbmc+IEZvbGxvdyBsb2NhbCByZWdpc3RyYXRpb24gYW5kIGhlbG1ldCBsYXdzLjwvcD48dWw+PGxpPlR5cGljYWwgcmFuZ2UgNjDigJM3NSBrbSAoZWNvIG1vZGUsIHJpZGVyIHdlaWdodCAmYW1wOyB0ZXJyYWluIGRlcGVuZGVudCk8L2xpPjxsaT5MQ0QgZGlzcGxheSB3aXRoIHNwZWVkICZhbXA7IGJhdHRlcnk8L2xpPjxsaT5NYW51ZmFjdHVyZXIgd2FycmFudHkgb24gbW90b3IgJmFtcDsgY29udHJvbGxlcjwvbGk+PC91bD4=', '[\"bike.webp\"]', 72499.00, 12, 8.00, 'Electric Mobility'),
(6, 'b41f57ca17615652', 'Premium Bamboo Cutting Board with Juice Groove (Medium)', 'KitchenCraft', 'TmF0dXJhbGx5IGFudGltaWNyb2JpYWwgYmFtYm9vIHN1cmZhY2UsIHJldmVyc2libGUgZGVzaWduLCBhbmQgcm91dGVkIGdyb292ZSB0byBjYXRjaCBsaXF1aWRz4oCUZ2VudGxlIG9uIGtuaWZlIGVkZ2VzLg==', 'PHA+PHN0cm9uZz5DYXJlOjwvc3Ryb25nPiBIYW5kIHdhc2ggYW5kIG9pbCBvY2Nhc2lvbmFsbHkgd2l0aCBmb29kLXNhZmUgbWluZXJhbCBvaWwuPC9wPjx1bD48bGk+QXBwcm94LiAzOCDDlyAyOCBjbSBjdXR0aW5nIGFyZWE8L2xpPjxsaT5Ob24tc2xpcCBmZWV0IG9uIHNlbGVjdCBiYXRjaGVzPC9saT48L3VsPg==', '[\"bord.jpg\"]', 899.00, 200, 15.00, 'Kitchen & Dining'),
(7, '45aa6018f0ab072c', 'Digital Upper Arm Blood Pressure Monitor (WHO Indicator)', 'MedCheck', 'Q2xpbmljYWxseSB2YWxpZGF0ZWQgYWxnb3JpdGhtLCBsYXJnZSBjdWZmIGZpdCAoMjLigJM0MiBjbSksIGlycmVndWxhciBoZWFydGJlYXQgZGV0ZWN0aW9uLCBhbmQgbWVtb3J5IGZvciB0d28gdXNlcnMu', 'PHA+PHN0cm9uZz5Ob3RlOjwvc3Ryb25nPiBGb3Igd2VsbG5lc3MgdHJhY2tpbmcgb25seeKAlG5vdCBhIHN1YnN0aXR1dGUgZm9yIHByb2Zlc3Npb25hbCBkaWFnbm9zaXMuPC9wPjx1bD48bGk+QmF0dGVyeS1vcGVyYXRlZCAoYmF0dGVyaWVzIGluY2x1ZGVkIHdoZXJlIHN0YXRlZCBvbiBib3gpPC9saT48bGk+VHJhdmVsIHBvdWNoIGluY2x1ZGVkPC9saT48L3VsPg==', '[\"bp monitor.jpeg\"]', 1699.00, 70, 14.00, 'Health & Wellness'),
(8, '31f52eb0341f635f', 'Certified HDMI 2.0 + Cat6 Ethernet Cable Combo Pack', 'LinkPro', 'MiBtIEhETUkgc3VwcG9ydGluZyA0SyBIRFIgd2hlcmUgc291cmNlcyBhbGxvdywgcGx1cyBzbmFnbGVzcyBSSjQ1IHBhdGNoIGxlYWQgZm9yIHN0YWJsZSB3aXJlZCBuZXR3b3JraW5nLg==', 'PHVsPjxsaT5Hb2xkLXBsYXRlZCBjb25uZWN0b3JzPC9saT48bGk+QnJhaWRlZCBzbGVldmUgb24gSERNSSB3aGVyZSBwaWN0dXJlZDwvbGk+PGxpPklkZWFsIGZvciBjb25zb2xlcywgUENzLCBhbmQgc21hcnQgVFZzPC9saT48L3VsPg==', '[\"cabels.webp\"]', 1299.00, 120, 11.00, 'IT Accessories'),
(9, '5d475b55520083da', 'APS-C Mirrorless Camera with 18–55 mm Kit Lens', 'OptixLab', 'MjQgTVAgc2Vuc29yLCBmYXN0IGh5YnJpZCBBRiwgNEsgdmlkZW8gKGNyb3Avc2V0dGluZ3MgZGVwZW5kZW50KSwgdGlsdGluZyB0b3VjaHNjcmVlbiwgYW5kIFdpLUZpIGltYWdlIHRyYW5zZmVyLg==', 'PHA+PHN0cm9uZz5LaXQgaW5jbHVkZXM6PC9zdHJvbmc+IGJvZHksIGtpdCB6b29tLCBiYXR0ZXJ5LCBjaGFyZ2VyLCBzdHJhcC48L3A+PHVsPjxsaT5JbnRlcmNoYW5nZWFibGUgbGVucyBlY29zeXN0ZW08L2xpPjxsaT5NYW51ZmFjdHVyZXIgd2FycmFudHk7IHJlZ2lzdGVyIG9ubGluZSB3aGVyZSByZXF1aXJlZDwvbGk+PC91bD4=', '[\"camera.jpg\"]', 52999.00, 22, 7.00, 'Cameras'),
(10, '1330ace82d08939d', '4-Ch HD DVR CCTV Kit (4 Bullet Cameras, Night Vision)', 'SecureView', 'T3V0ZG9vci1yYXRlZCBidWxsZXRzIHdpdGggSVIgbmlnaHQgdmlzaW9uLCBEVlIgd2l0aCBIREQgYmF5LCBtb2JpbGUgYXBwIHZpZXdpbmcsIGFuZCBtb3Rpb24tZGV0ZWN0aW9uIGFsZXJ0cy4=', 'PHA+PHN0cm9uZz5JbnN0YWxsOjwvc3Ryb25nPiBQcm9mZXNzaW9uYWwgY2FibGluZyByZWNvbW1lbmRlZCBmb3IgbG9uZyBydW5zLjwvcD48dWw+PGxpPldlYXRoZXJwcm9vZiBob3VzaW5nczwvbGk+PGxpPlJlY29yZGluZyBzY2hlZHVsZSAmYW1wOyBiYWNrdXAgb3B0aW9uczwvbGk+PC91bD4=', '[\"cctv.webp\"]', 8999.00, 35, 13.00, 'Security'),
(11, 'd1d8a8fe79839280', '33 W USB-C PD GaN Fast Charger with Cable', 'ChargeMax', 'Q29vbGVyLXJ1bm5pbmcgR2FOIGRlc2lnbjsgc3VwcG9ydHMgUEQvUFBTIHByb2ZpbGVzIGNvbW1vbiBvbiBwaG9uZXMgYW5kIHRhYmxldHM7IGluY2x1ZGVzIDEgbSBVU0ItQyBjYWJsZS4=', 'PHVsPjxsaT5CSVMtY29tcGxpYW50IEluZGlhbiBwbHVnPC9saT48bGk+TXVsdGktbGF5ZXIgc2FmZXR5IChPVlAsIE9DUCwgT1RQKTwvbGk+PGxpPkNvbXBhY3QgZm9yIHRyYXZlbDwvbGk+PC91bD4=', '[\"charger.jpeg\"]', 1299.00, 180, 16.00, 'Mobile Accessories'),
(12, '98bf2f162f98d8f1', 'Hybrid Shockproof Phone Case (Clear Back, Air Cushion)', 'ShieldSkin', 'UmFpc2VkIGxpcCBmb3IgY2FtZXJhICZhbXA7IHNjcmVlbiwgdGFjdGlsZSBidXR0b25zLCB5ZWxsb3dpbmctcmVzaXN0YW50IFRQVSBidW1wZXLigJRtb2RlbCBtYXRjaGVkIHRvIGN1cnJlbnQgYmVzdHNlbGxlcnMu', 'PHA+PHN0cm9uZz5Db21wYXRpYmlsaXR5Ojwvc3Ryb25nPiBDb25maXJtIGV4YWN0IHBob25lIG1vZGVsIGJlZm9yZSBjaGVja291dC48L3A+PHVsPjxsaT5NaWxpdGFyeS1zdHlsZSBkcm9wIHRlc3RpbmcgY2xhaW1zIHZhcnkgYnkgYmF0Y2g8L2xpPjxsaT5XaXJlbGVzcyBjaGFyZ2luZyBjb21wYXRpYmxlIG9uIG1vc3QgbW9kZWxzPC9saT48L3VsPg==', '[\"cover.jpeg\"]', 449.00, 300, 22.00, 'Mobile Accessories'),
(13, '8f8ebee1b73a851a', 'Latest-Gen Octa-Core Desktop Processor (Box Pack, Cooler Included)', 'ComputeCore', 'SGlnaCBJUEMgYXJjaGl0ZWN0dXJlIGZvciBnYW1pbmcgJmFtcDsgY3JlYXRvciB3b3JrbG9hZHM7IFBDSWUgR2VuIHN1cHBvcnQgYXMgcGVyIHNlcmllczsgd2FycmFudHkgdmlhIGF1dGhvcmlzZWQgc2VydmljZS4=', 'PHVsPjxsaT5DaGVjayBtb3RoZXJib2FyZCBCSU9TIGNvbXBhdGliaWxpdHkgYmVmb3JlIHB1cmNoYXNlPC9saT48bGk+VGhlcm1hbCBwYXN0ZSBwcmUtYXBwbGllZCBvbiBidW5kbGVkIGNvb2xlciB3aGVyZSBhcHBsaWNhYmxlPC9saT48bGk+VmVyaWZ5IFBTVSBoZWFkcm9vbSBmb3IgR1BVIHBhaXJpbmc8L2xpPjwvdWw+', '[\"cpu.jpeg\"]', 22499.00, 40, 6.00, 'PC Components'),
(14, 'dc2fc9c1c045a13c', 'ElectroShop Branded Reusable Shopping Bag (Large)', 'ElectroShop', 'SGVhdnktZHV0eSBub24td292ZW4gdG90ZSB3aXRoIGxvbmcgaGFuZGxlc+KAlGNhcnJ5IGxhcHRvcHMsIGdyb2Nlcmllcywgb3IgY2FydCBoYXVscyBmcm9tIG91ciBzdG9yZS4=', 'PHA+U2hvdyB5b3VyIEVsZWN0cm9TaG9wIGxvdmUgYXQgY2hlY2tvdXQgbGluZXMgYW5kIGNhbXB1cy48L3A+PHVsPjxsaT5Gb2xkYWJsZSAmYW1wOyB3YXNoYWJsZTwvbGk+PGxpPkNhcGFjaXR5IHN1aXRlZCBmb3IgZGFpbHkgZXJyYW5kczwvbGk+PC91bD4=', '[\"electroshop.png\"]', 199.00, 500, 25.00, 'Merchandise'),
(15, '16875aa9212ebcc4', 'High Speed Ceiling Fan (1200 mm, Anti-Dust Coating)', 'AirFlow', 'RW5lcmd5LWVmZmljaWVudCBtb3RvciwgYmFsYW5jZWQgYmxhZGVzIGZvciBsb3cgd29iYmxlLCBkdWFsLXRvbmUgY29sb3VyIG9wdGlvbnMgYXMgcGVyIGJhdGNoLg==', 'PHVsPjxsaT4yLXllYXIgd2FycmFudHkgdHlwaWNhbCBvbiBtb3RvcjwvbGk+PGxpPlN1aXRhYmxlIGZvciBtZWRpdW0gcm9vbXM8L2xpPjxsaT5JbnN0YWxsYXRpb24gY2hhcmdlcyBtYXkgYXBwbHkgbG9jYWxseTwvbGk+PC91bD4=', '[\"fan.jpg\"]', 3199.00, 55, 12.00, 'Home Appliances'),
(16, '6465054a90a8ef51', 'Direct Cool Single Door Refrigerator (190 L, 3 Star)', 'FreshNest', 'U3RhYmlsaXNlci1mcmVlIG9wZXJhdGlvbiB3aXRoaW4gcmF0ZWQgcmFuZ2UsIHRvdWdoZW5lZCBnbGFzcyBzaGVsdmVzLCBsYXJnZSB2ZWdldGFibGUgYmFza2V0LCBhbmQgbWFudWFsIGRlZnJvc3Qu', 'PHVsPjxsaT5Eb29yIG9yaWVudGF0aW9uIHJldmVyc2libGUgb24gbWFueSBTS1Vz4oCUY29uZmlybSBzdG9yZSBsaXN0aW5nPC9saT48bGk+SWRlYWwgZm9yIGNvbXBhY3Qga2l0Y2hlbnMgJmFtcDsgUEcgc2V0dXBzPC9saT48L3VsPg==', '[\"freeg.webp\"]', 15490.00, 25, 11.00, 'Home Appliances'),
(17, 'ea3bd1a48ef565ad', 'Tempered Glass Screen Protector (9H, Oleophobic Coating)', 'CrystalGuard', 'Q2FzZS1mcmllbmRseSBjdXRvdXRzLCBidWJibGUtZnJlZSBhZGhlc2l2ZSBraXQgaW5jbHVkZWTigJRtYXRjaCBwaG9uZSBtb2RlbCBiZWZvcmUgYnV5aW5nLg==', 'PHVsPjxsaT5Ub3VjaCBzZW5zaXRpdml0eSByZXRhaW5lZDwvbGk+PGxpPkluY2x1ZGVzIHdpcGVzICZhbXA7IGFsaWdubWVudCBmcmFtZSB3aGVyZSBwaWN0dXJlZDwvbGk+PC91bD4=', '[\"glass.webp\"]', 299.00, 400, 30.00, 'Mobile Accessories'),
(18, '4fc2b700747a2998', '8 GB GDDR6 Gaming Graphics Card (PCIe 4.0, Dual Fan)', 'PixelForge', 'MTA4MHAvMTQ0MHAgZ2FtaW5nIGluIG1vZGVybiB0aXRsZXM7IERMU1MvRlNSIHdoZXJlIHN1cHBvcnRlZDsgZmFjdG9yeSBPQyBwcm9maWxlcyB2aWEgc29mdHdhcmUu', 'PHVsPjxsaT5DaGVjayBjYXNlIGxlbmd0aCAmYW1wOyBQU1Ugd2F0dGFnZSAvIFBDSWUgcG93ZXIgY29ubmVjdG9yczwvbGk+PGxpPkRyaXZlciB1cGRhdGVzIGZyb20gR1BVIHZlbmRvciBzaXRlPC9saT48L3VsPg==', '[\"graphics card.jpg\"]', 32999.00, 28, 8.00, 'PC Components'),
(19, '55da2eb6ccf393cc', 'Steam Iron with Ceramic Soleplate (1600 W)', 'PressEase', 'VmVydGljYWwgc3RlYW0gYnVyc3QsIGFudGktZHJpcCwgc2VsZi1jbGVhbiBmdW5jdGlvbiwgYW5kIHByZWNpc2lvbiB0aXAgZm9yIGNvbGxhcnMu', 'PHVsPjxsaT4zNjDCsCBzd2l2ZWwgY29yZDwvbGk+PGxpPldhdGVyIHNwcmF5ICZhbXA7IHZhcmlhYmxlIHN0ZWFtPC9saT48bGk+QklTIHBsdWcgJmFtcDsgc2FmZXR5IHNodXQtb2ZmIHdoZXJlIGVxdWlwcGVkPC9saT48L3VsPg==', '[\"iron.jpg\"]', 1499.00, 90, 17.00, 'Home Appliances'),
(20, 'b68aac96de7251b3', 'Stainless Steel Electric Kettle (1.7 L, Auto Shut-Off)', 'BoilQuick', 'Q29uY2VhbGVkIGhlYXRpbmcgZWxlbWVudCwgYm9pbC1kcnkgcHJvdGVjdGlvbiwgMzYwwrAgY29yZGxlc3MgYmFzZSwgd2lkZSBtb3V0aCBmb3IgY2xlYW5pbmcu', 'PHVsPjxsaT5QZXJmZWN0IGZvciB0ZWEsIGluc3RhbnQgbm9vZGxlcyAmYW1wOyBiYWJ5IGZvcm11bGEgcHJlcDwvbGk+PGxpPkNvb2wtdG91Y2ggaGFuZGxlPC9saT48L3VsPg==', '[\"katel.jpg\"]', 1199.00, 110, 14.00, 'Kitchen Appliances'),
(21, 'eb41b7a2a8816e91', 'Wireless Mechanical Keyboard (Hot-Swap, RGB)', 'KeyForge', 'VGFjdGlsZSBzd2l0Y2hlcyAoYmF0Y2gtZGVwZW5kZW50KSwgVVNCLUMgY2hhcmdpbmcsIG11bHRpLWRldmljZSBCbHVldG9vdGgsIE1hYyAmYW1wOyBXaW5kb3dzIGxlZ2VuZHMu', 'PHVsPjxsaT5Tb2Z0d2FyZSByZW1hcHBpbmcgb24gV2luZG93czwvbGk+PGxpPlBhZGRlZCB3cmlzdCByZXN0IG9wdGlvbmFsIHBlciBTS1U8L2xpPjwvdWw+', '[\"keybord.jpeg\"]', 3499.00, 65, 13.00, 'IT Accessories'),
(22, '3985d802c5bf2929', '15.6\" FHD Thin & Light Laptop (16 GB RAM, 512 GB SSD)', 'NovaBook', 'TGF0ZXN0LWdlbiBlZmZpY2llbmN5IGNvcmVzLCBXaS1GaSA2LCBiYWNrbGl0IGtleWJvYXJkLCBmYXN0IFNTRCwgaWRlYWwgZm9yIHN0dWR5ICZhbXA7IG9mZmljZSB3b3JrbG9hZHMu', 'PHVsPjxsaT5Qb3J0czogVVNCLUMsIFVTQi1BLCBIRE1JLCBhdWRpbyBqYWNrIChleGFjdCBsYXlvdXQgbWF5IHZhcnkpPC9saT48bGk+UHJlLWluc3RhbGxlZCBPUyB3aXRoIHJlY292ZXJ5IHBhcnRpdGlvbjwvbGk+PGxpPjEteWVhciBjYXJyeS1pbiB3YXJyYW50eSB0eXBpY2FsPC9saT48L3VsPg==', '[\"laptop.jpeg\"]', 56990.00, 30, 10.00, 'Laptops'),
(23, '391a94b97f2782f6', 'MACBOOK AIR 1', 'Apple', 'RmFubGVzcyBzaWxlbnQgZGVzaWduLCBhbGwtZGF5IGJhdHRlcnksIGJyaWxsaWFudCBMaXF1aWQgUmV0aW5hIGRpc3BsYXksIGFuZCBBcHBsZSBzaWxpY29uIHBlcmZvcm1hbmNlIGZvciB3b3JrICZhbXA7IGNyZWF0aXZpdHku', 'PHA+PHN0cm9uZz5Ob3RlOjwvc3Ryb25nPiBQcm9kdWN0IG5hbWUgbWF0Y2hlcyBzdG9yZWZyb250IOKAnERlYWwgb2YgdGhlIERheeKAnSBmaWx0ZXIuPC9wPjx1bD48bGk+RXhhY3QgY2hpcCBnZW5lcmF0aW9uICZhbXA7IFJBTSBwZXIgaW52b2ljZTwvbGk+PGxpPlJlZ2lzdGVyIGZvciBBcHBsZSB3YXJyYW50eTwvbGk+PGxpPkNvbG91ciBhdmFpbGFiaWxpdHkgdmFyaWVzPC9saT48L3VsPg==', '[\"mac.jpeg\"]', 114900.00, 15, 5.00, 'Laptops'),
(24, '21b6304bd45d7213', '550 W Mixer Grinder with 3 Stainless Steel Jars', 'BlendMaster', 'T3ZlcmxvYWQgcHJvdGVjdG9yLCBmbG93IGJyZWFrZXJzIGZvciBzbW9vdGggZ3JpbmRpbmcsIHZhY3V1bSBmZWV0IGZvciBzdGFiaWxpdHku', 'PHVsPjxsaT5XZXQgZ3JpbmRpbmcsIGRyeSBzcGljZXMgJmFtcDsgY2h1dG5leSBqYXJzPC9saT48bGk+Mi15ZWFyIG1vdG9yIHdhcnJhbnR5IHR5cGljYWw8L2xpPjwvdWw+', '[\"mixer.jpeg\"]', 4499.00, 48, 12.00, 'Kitchen Appliances'),
(25, '8f1f89a2779a7270', 'High-Capacity Replacement Smartphone Battery (IC Protected)', 'PowerCell', 'TWF0Y2ggcGhvbmUgbW9kZWwgZXhhY3RseeKAlExpLWlvbiB3aXRoIFBDTSBwcm90ZWN0aW9uOyBwcm9mZXNzaW9uYWwgaW5zdGFsbGF0aW9uIHJlY29tbWVuZGVkLg==', 'PHA+PHN0cm9uZz5TYWZldHk6PC9zdHJvbmc+IERvIG5vdCBwdW5jdHVyZSBvciBleHBvc2UgdG8gaGVhdC48L3A+PHVsPjxsaT5UeXBpY2FsIGN5Y2xlIGxpZmUgcGVyIE9FTSBndWlkZWxpbmVzPC9saT48L3VsPg==', '[\"mobile battery.webp\"]', 2199.00, 75, 10.00, 'Mobile Accessories'),
(26, '88533feaeafe0290', 'Braided USB-A to USB-C Fast Charging Cable (2 m, 3A)', 'CableKind', 'UmVpbmZvcmNlZCBzdHJhaW4gcmVsaWVmLCBoaWdoLXNwZWVkIGRhdGEgc3VwcG9ydCB3aGVyZSBVU0IgMi4wLzMueCBhcHBsaWVz4oCUdGFuZ2xlLXJlc2lzdGFudCB3ZWF2ZS4=', 'PHVsPjxsaT5JZGVhbCB3aXRoIDE44oCTMzMgVyBjaGFyZ2VyczwvbGk+PGxpPkNvbG91ciBtYXkgdmFyeSBieSBiYXRjaDwvbGk+PC91bD4=', '[\"mobile cabel.jpeg\"]', 599.00, 250, 20.00, 'Mobile Accessories'),
(27, '041e29d413014c7f', '27\" QHD IPS Monitor (75 Hz, AMD FreeSync)', 'ViewCraft', 'c1JHQiBjb3ZlcmFnZSBzdWl0ZWQgZm9yIHdvcmsgJmFtcDsgY2FzdWFsIGdhbWluZzsgc2xpbSBiZXplbHM7IHRpbHQtYWRqdXN0IHN0YW5kIChzZWUgU0tVIGZvciBWRVNBKS4=', 'PHVsPjxsaT5IRE1JICsgRGlzcGxheVBvcnQgaW5wdXRzIHR5cGljYWw8L2xpPjxsaT5Mb3cgYmx1ZSBsaWdodCAmYW1wOyBmbGlja2VyLXNhZmUgbW9kZXM8L2xpPjwvdWw+', '[\"monitor.jpeg\"]', 18999.00, 34, 9.00, 'Monitors'),
(28, '8098714db464cbee', '24\" FHD IPS Office Monitor (75 Hz, Frameless)', 'ViewCraft', 'Q3Jpc3AgdGV4dCBmb3Igc3ByZWFkc2hlZXRzICZhbXA7IGNvZGluZzsgSERNSSAmYW1wOyBWR0Egb24gc2VsZWN0IGJhdGNoZXM7IGV5ZS1jYXJlIG1vZGVzLg==', 'PHVsPjxsaT5Db21wYWN0IGZvb3RwcmludCBmb3IgZHVhbC1tb25pdG9yIHNldHVwczwvbGk+PGxpPkluY2x1ZGVzIGFwcHJvcHJpYXRlIHZpZGVvIGNhYmxlIGluIGJveDwvbGk+PC91bD4=', '[\"monitor1.jpg\"]', 11299.00, 42, 10.00, 'Monitors'),
(29, 'af8e7e5af0a37662', '128 GB USB 3.2 Gen 1 Metal Flash Drive', 'DataStick', 'Q2FwbGVzcyBzbGlkaW5nIGRlc2lnbiwga2V5cmluZyBob2xlLCByZWFkIHNwZWVkcyB0eXBpY2FsIG9mIEdlbiAxIGZsYXNo4oCUZ3JlYXQgZm9yIGJhY2t1cHMgJmFtcDsgbWVkaWEu', 'PHVsPjxsaT5CYWNrd2FyZCBjb21wYXRpYmxlIHdpdGggVVNCIDIuMCBwb3J0czwvbGk+PGxpPjUteWVhciBsaW1pdGVkIHdhcnJhbnR5IHR5cGljYWw8L2xpPjwvdWw+', '[\"pendrive.jpeg\"]', 899.00, 200, 18.00, 'IT Accessories'),
(30, 'cec997a821f51e75', '5G Smartphone (128 GB Storage, 50 MP Triple Camera)', 'PulseMobile', 'MTIwIEh6IEZIRCsgZGlzcGxheSwgbGFyZ2UgYmF0dGVyeSB3aXRoIGZhc3QgY2hhcmdlLCBjbGVhbiBVSSB3aXRoIHByb21pc2VkIE9TIHVwZGF0ZXMgd2luZG93Lg==', 'PHVsPjxsaT5EdWFsIFNJTSArIG1pY3JvU0Qgb24gc3VwcG9ydGVkIHZhcmlhbnRzPC9saT48bGk+SW4tYm94IHByb3RlY3RpdmUgY2FzZSAmYW1wOyBjYWJsZTwvbGk+PC91bD4=', '[\"phone.jpeg\"]', 26999.00, 55, 11.00, 'Mobiles'),
(31, 'de5eda5c7135df96', 'Wi-Fi Ink Tank Colour Printer (Scan & Copy)', 'PrintWell', 'VWx0cmEtbG93IGNvc3QgcGVyIHBhZ2Ugd2l0aCByZWZpbGxhYmxlIHRhbmtzOyBtb2JpbGUgcHJpbnRpbmcgYXBwczsgYm9yZGVybGVzcyBwaG90b3MgdXAgdG8gNMOXNiIu', 'PHVsPjxsaT5Jbml0aWFsIGluayBzZXQgaW4gYm94PC9saT48bGk+UmVjb21tZW5kZWQgbW9udGhseSBkdXR5IGN5Y2xlIGluIG1hbnVhbDwvbGk+PC91bD4=', '[\"printer.jpeg\"]', 15499.00, 28, 10.00, 'Office Electronics'),
(32, '9be72ffe8eef83e4', 'Full HD LED Projector (3500 LM Class, Wireless Display)', 'CineBeam', 'QmlnLXNjcmVlbiBtb3ZpZXMgJmFtcDsgc3BvcnRzOyBrZXlzdG9uZSBjb3JyZWN0aW9uOyBidWlsdC1pbiBzcGVha2VyOyBIRE1JL1VTQiBpbnB1dHMu', 'PHVsPjxsaT5BbWJpZW50IGxpZ2h0IGFmZmVjdHMgcGVyY2VpdmVkIGJyaWdodG5lc3M8L2xpPjxsaT5Ucmlwb2QgLyBjZWlsaW5nIG1vdW50IG9wdGlvbmFsPC9saT48L3VsPg==', '[\"projector.jpeg\"]', 28999.00, 20, 12.00, 'Home Entertainment'),
(33, '55455786e8799e8a', 'Minimal Typography Wall Art Trio (Unframed Prints)', 'Studio Line', 'VGhyZWUgY29vcmRpbmF0ZWQgbW9ub2Nocm9tZSBxdW90ZSBwcmludHMgb24gbWF0dGUgYXJ0IHBhcGVy4oCUcGVyZmVjdCBmb3IgZGVza3MsIHN0dWRpb3MsIG9yIGdhbGxlcnkgd2FsbHMu', 'PHA+PHN0cm9uZz5XaGF0IHlvdSBnZXQ8L3N0cm9uZz48L3A+PHA+VGhyZWUgbWF0Y2hpbmcgQTQtc2l6ZWQgcHJpbnRzIGZlYXR1cmluZyBjbGVhbiB0eXBvZ3JhcGh5LiBTaGlwcyByb2xsZWQgaW4gYSBwcm90ZWN0aXZlIHR1YmUuPC9wPjx1bD48bGk+TWF0dGUgMjEwIEdTTSBwb3N0ZXIgcGFwZXI8L2xpPjxsaT5FYXN5IHRvIGZyYW1lIGluIHN0YW5kYXJkIEE0IGZyYW1lczwvbGk+PC91bD48cD48ZW0+RnJhbWVzIG5vdCBpbmNsdWRlZC48L2VtPjwvcD4=', '[\"quotes.svg\"]', 749.00, 150, 20.00, 'Lifestyle & Decor'),
(34, '9c51842561f407a2', 'Wi-Fi 6 AX3000 Dual Band Gigabit Router', 'NetStream', 'T0ZETUEgJmFtcDsgTVUtTUlNTyBmb3IgYnVzeSBob21lczsgV1BBMzsgZWFzeSBhcHAgc2V0dXA7IGZvdXIgZ2lnYWJpdCBMQU4gcG9ydHMu', 'PHVsPjxsaT5JU1AgZmlicmUgbW9kZW0gcmVxdWlyZWQgZm9yIFdBTjwvbGk+PGxpPldhbGwtbW91bnQgc2xvdHMgb24gYmFzZTwvbGk+PC91bD4=', '[\"router.jpg\"]', 2499.00, 70, 15.00, 'Networking'),
(35, '64a35ef29f575df6', 'Samsung Galaxy S25', 'Samsung', 'RmxhZ3NoaXAgQUkgcGhvdG9ncmFwaHksIGJyaWdodGVzdCBkaXNwbGF5IGluIHNlcmllcywgYWxsLWRheSBiYXR0ZXJ5ICZhbXA7IHVsdHJhLWZhc3QgY2hhcmdpbmcgc3RhY2su', 'PHA+PHN0cm9uZz5Ob3RlOjwvc3Ryb25nPiBQcm9kdWN0IG5hbWUgbWF0Y2hlcyBzdG9yZWZyb250IOKAnERlYWwgb2YgdGhlIERheeKAnSBmaWx0ZXIuPC9wPjx1bD48bGk+UmVnaW9uYWwgYmFuZHMgJmFtcDsgUkFNL3N0b3JhZ2UgcGVyIGludm9pY2U8L2xpPjxsaT5SZWdpc3RlciBTYW1zdW5nIENhcmUrIGlmIHB1cmNoYXNlZDwvbGk+PGxpPkluLWJveCBjYWJsZSAmYW1wOyBTSU0gdG9vbDwvbGk+PC91bD4=', '[\"s25.jpeg\"]', 84999.00, 40, 8.00, 'Mobiles'),
(36, '22c81270731d248c', 'Cordless Beard Trimmer with USB Fast Charge (20 Length Settings)', 'TrimPro', 'U2tpbi1mcmllbmRseSBibGFkZXMsIHdhc2hhYmxlIGhlYWQsIHRyYXZlbCBsb2NrLCBMRUQgYmF0dGVyeSBnYXVnZSBvbiBwcmVtaXVtIHRyaW1zLg==', 'PHVsPjxsaT45MCsgbWludXRlcyBydW50aW1lIHR5cGljYWw8L2xpPjxsaT5HdWlkZSBjb21icyBpbmNsdWRlZDwvbGk+PC91bD4=', '[\"trimmer.webp\"]', 1599.00, 130, 16.00, 'Personal Care'),
(37, 'a9b5ff45a16e6344', 'Silent Sweep Wall Clock (30 cm, Minimal Dial)', 'TimeHue', 'Tm9uLXRpY2tpbmcgcXVhcnR6IG1vdmVtZW50LCBjbGVhciBudW1lcmFscywgbGlnaHR3ZWlnaHQgYm9keeKAlGxpdmluZyByb29tICZhbXA7IG9mZmljZSBmcmllbmRseS4=', 'PHVsPjxsaT5TaW5nbGUgQUEgYmF0dGVyeSAobm90IGFsd2F5cyBpbmNsdWRlZOKAlGNoZWNrIGJveCk8L2xpPjxsaT5FYXN5IHdhbGwgbW91bnRpbmcgaG9vazwvbGk+PC91bD4=', '[\"wall clock.jpg\"]', 1299.00, 95, 14.00, 'Lifestyle & Decor'),
(38, '91c36a59c50e6268', 'Fully Automatic Front Load Washer (7 kg, Inverter)', 'WashMate', 'U3RlYW0gaHlnaWVuZSBvcHRpb24gb24gc2VsZWN0IHByb2dyYW1zLCBpbnZlcnRlciBtb3RvciBmb3IgcXVpZXRlciBzcGlucywgY2hpbGQgbG9jay4=', 'PHVsPjxsaT5JbnN0YWxsYXRpb24gJmFtcDsgZGVtbyBieSBhdXRob3Jpc2VkIGFnZW50PC9saT48bGk+SW5sZXQgaG9zZSAmYW1wOyBkcmFpbiBhY2Nlc3NvcmllcyBpbiBib3g8L2xpPjwvdWw+', '[\"washing macine.jpeg\"]', 28990.00, 16, 10.00, 'Home Appliances'),
(39, 'f125c89069b90b20', 'Classic Analog Stainless Steel Watch (Water Resistant 5 ATM)', 'ChronoMark', 'TWluZXJhbCBnbGFzcywgbHVtaW5vdXMgaGFuZHMsIGRhdGUgd2luZG93LCBicmFjZWxldCB3aXRoIHB1c2gtYnV0dG9uIGRlcGxveWFudCBjbGFzcC4=', 'PHVsPjxsaT4yLXllYXIgbW92ZW1lbnQgd2FycmFudHkgdHlwaWNhbDwvbGk+PGxpPkF2b2lkIGhvdCB3YXRlciBkZXNwaXRlIFdSIHJhdGluZzwvbGk+PC91bD4=', '[\"watch-1.jpg\"]', 4999.00, 60, 14.00, 'Wearables'),
(40, '3d97def083554ab6', 'Sports Chronograph Watch with Silicone Strap', 'ChronoMark', 'U3RvcHdhdGNoIHN1YmRpYWxzLCBydWdnZWQgY2FzZSBmaW5pc2gsIGJyZWF0aGFibGUgc3RyYXDigJRneW0gdG8gd2Vla2VuZCB3ZWFyLg==', 'PHVsPjxsaT5CYXR0ZXJ5IHF1YXJ0eiBtb3ZlbWVudDwvbGk+PGxpPlNjcmF0Y2gtcmVzaXN0YW50IG1pbmVyYWwgY3J5c3RhbDwvbGk+PC91bD4=', '[\"watch-2.jpg\"]', 3499.00, 72, 17.00, 'Wearables'),
(41, 'f85fcf5e814be93c', 'PulseFit BT Calling Smartwatch (1.83\" HD)', 'ElectroNova', 'Qmx1ZXRvb3RoIGNhbGxpbmcsIFNwT+KCgiAmIGhlYXJ0IHJhdGUgbW9uaXRvcmluZywgMTAwKyBzcG9ydHMgbW9kZXMsIGFuZCB1cCB0byA3LWRheSBiYXR0ZXJ5IGxpZmUu', 'PHA+PHN0cm9uZz5PdmVydmlldzwvc3Ryb25nPjwvcD48cD5WZXJzYXRpbGUgZXZlcnlkYXkgc21hcnR3YXRjaCB3aXRoIGNyaXNwIGRpc3BsYXkgYW5kIGNvbXByZWhlbnNpdmUgaGVhbHRoIG1ldHJpY3MuPC9wPjx1bD48bGk+MS44My1pbmNoIEhEIGNvbG91ciBkaXNwbGF5PC9saT48bGk+Qmx1ZXRvb3RoIGNhbGxpbmcgd2l0aCBzcGVha2VyICZhbXA7IG1pYzwvbGk+PGxpPkhlYXJ0IHJhdGUsIFNwT+KCgiwgc2xlZXAgdHJhY2tpbmc8L2xpPjxsaT5JUDY4IChsYWItcmF0ZWQpPC9saT48L3VsPg==', '[\"watch.svg\"]', 3499.00, 80, 15.00, 'Smart Wearables'),
(42, '3286cc883567a3b7', 'ARC Welding Inverter (200 A, IGBT)', 'SparkWeld', 'UG9ydGFibGUgTU1BIGludmVydGVyOyBob3Qgc3RhcnQgJmFtcDsgYW50aS1zdGljazsgZmFuIGNvb2xlZOKAlGluY2x1ZGVzIGVsZWN0cm9kZSBob2xkZXIgJmFtcDsgZWFydGggY2xhbXAu', 'PHA+PHN0cm9uZz5TYWZldHk6PC9zdHJvbmc+IFdlbGRpbmcgaGVsbWV0ICZhbXA7IGdsb3ZlcyBtYW5kYXRvcnnigJRzb2xkIHNlcGFyYXRlbHkgdW5sZXNzIGJ1bmRsZWQuPC9wPjx1bD48bGk+R2VuZXJhdG9yLWNvbXBhdGlibGUgd2l0aGluIHZvbHRhZ2UgbGltaXRzPC9saT48L3VsPg==', '[\"welding macin.jpeg\"]', 8499.00, 25, 9.00, 'Tools & Hardware'),
(43, '33498f5994df9183', 'Copper Core Electrical Wire Bundle (House Wiring Kit)', 'SafeWire', 'UFZDIGluc3VsYXRlZCBGUi1ncmFkZSB3aXJlcyBpbiBjb21tb24gZ2F1Z2VzIGZvciBsaWdodGluZyAmYW1wOyBzb2NrZXQgY2lyY3VpdHPigJRlbGVjdHJpY2lhbiBpbnN0YWxsYXRpb24gb25seS4=', 'PHA+PHN0cm9uZz5EaXNjbGFpbWVyOjwvc3Ryb25nPiBOYXRpb25hbCBlbGVjdHJpY2FsIGNvZGUgJmFtcDsgbGljZW5zZWQgZWxlY3RyaWNpYW4gcmVxdWlyZWQuPC9wPjx1bD48bGk+TGVuZ3RocyBidW5kbGVkIGFzIHBlciByZXRhaWwgcGFjazwvbGk+PC91bD4=', '[\"wire cabels.png\"]', 1299.00, 85, 11.00, 'Electricals');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `sl` int(11) NOT NULL,
  `order_id` text NOT NULL,
  `cart` text DEFAULT NULL,
  `cid` varchar(128) DEFAULT NULL,
  `address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`address`)),
  `status` varchar(50) DEFAULT '200',
  `purchase_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`sl`, `order_id`, `cart`, `cid`, `address`, `status`, `purchase_date`) VALUES
(1, '1e591f8549e25ab4', '[{\"qty\":\"1\",\"pid\":\"391a94b97f2782f6\",\"amt\":\"109155\"},{\"qty\":\"1\",\"pid\":\"84dccdb397c3fdf9\",\"amt\":\"5004.09\"},{\"qty\":\"1\",\"pid\":\"d0e7c29fbc779323\",\"amt\":\"35099.1\"},{\"qty\":\"1\",\"pid\":\"b41f57ca17615652\",\"amt\":\"764.15\"}]', '3a7fa8eba7490cae', '\"16\\/7 ashokenagar\"', 'Cancelled', '2026-05-13 15:28:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`sl`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`sl`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`sl`),
  ADD KEY `cid` (`cid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
