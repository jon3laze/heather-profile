@extends('layouts.app')

@section('content')
    <div class="flex justify-center py-5 text-sm">
        <pre>
            <code class="language-css">
// Color system
//
//////////////////////
// DOT Highway Colors

// DOT Highway Brown 10055
// Lab: 35.97, 11.85, 13.01
// HLC: 48, 36, 18
// LRV:  Approx. 9
$dot-hwy-brown-hex: #6B4D40 !default; // HEX
$dot-hwy-brown-cmyk: cmyk(0, 29, 41, 58) !default; // CMYK
$dot-hwy-brown-rgb: rgb(107, 77, 64) !default; // RGB

// DOT Highway Red 11086
// Lab: 38.32, 35.06, 16.56
// HLC: 25, 38, 39
// LRV:  Approx. 10
$dot-hwy-red-hex: #914042 !default; // HEX
$dot-hwy-red-cmyk: cmyk(0, 56, 54, 43) !default; // CMYK
$dot-hwy-red-rgb: rgb(145, 64, 66) !default; // RGB

// DOT Highway Red 11105
// Lab: 39.72, 42.51, 19.83
// HLC: 25, 40, 47
// LRV:  Approx. 11
$dot-hwy-red-1-hex: #9F3B40 !default; // HEX
$dot-hwy-red-1-cmyk: cmyk(0, 63, 60, 38) !default; // CMYK
$dot-hwy-red-1-rgb: rgb(159, 59, 64) !default; // RGB

// DOT Highway Orange 12243
// Lab: 57.33, 38.77, 46.2
// HLC: 50, 57, 60
// LRV: Approx. 25
$dot-hwy-orange-hex: #D26C3A !default; // HEX
$dot-hwy-orange-cmyk: cmyk(0, 49, 72, 18) !default; // CMYK
$dot-hwy-orange-rgb: rgb(210, 108, 58) !default; // RGB

// DOT Highway Yellow 13507
// Lab: 74.92, 22.42, 71.15
// HLC: 73, 75, 75
// LRV: Approx. 48
$dot-hwy-yellow-hex: #F5A727 !default; // HEX
$dot-hwy-yellow-cmyk: cmyk(0, 32, 84, 4) !default; // CMYK
$dot-hwy-yellow-rgb: rgb(245, 167, 39) !default; // RGB

// DOT Highway Yellow ANA 506 13538
// Lab: 72.14, 22,71, 71.05
// HLC: 72, 72, 75
// LRV: Approx. 44
$dot-hwy-yellow-506-hex: #ECA01D !default; // HEX
$dot-hwy-yellow-506-cmyk: cmyk(0, 32, 88, 7) !default; // CMYK
$dot-hwy-yellow-506-rgb: rgb(236, 160, 29) !default; // RGB

// DOT Highway Green 14066
// Lab: 35.12, -20.41, 4.24
// HLC: 168, 35, 21
// LRV: Approx. 9
$dot-hwy-green-hex: #2C5B4B !default; // HEX
$dot-hwy-green-cmyk: cmyk(52, 0, 18, 64) !default; // CMYK
$dot-hwy-green-rgb: rgb(44, 91, 75) !default; // RGB

// DOT Highway Green 14109
// Lab: 37.17, -21.33, 5.63
// HLC: 165, 37, 22
// LRV: Approx. 10
$dot-hwy-green-1-hex: #30614E !default; // HEX
$dot-hwy-green-1-cmyk: cmyk(51, 0, 20, 62) !default; // CMYK
$dot-hwy-green-1-rgb: rgb(48, 97, 78) !default; // RGB

// DOT Highway Blue 15090
// Lab: 37.12, -9.55, -21.26
// HLC: 246, 37, 23
// LRV: Approx. 10
$dot-hwy-blue-hex: #2E5D79 !default; // HEX
$dot-hwy-blue-cmyk: cmyk(62, 23, 0, 53) !default; // CMYK
$dot-hwy-blue-rgb: rgb(46, 93, 121) !default; // RGB

// DOT Highway Blue 15065
// Lab: 38.14, -8.46, -24.75
// HLC: 251, 38, 26
// LRV: Approx. 10
$dot-hwy-blue-1-hex: #2E5F82 !default; // HEX
$dot-hwy-blue-1-cmyk: cmyk(65, 27, 0, 49) !default; // CMYK
$dot-hwy-blue-1-rgb: rgb(46, 95, 130) !default; // RGB

//////////////////////
// OSHA Safety Colors

// OSHA Safety Red 11140
// Lab: 39.84, 41.74, 20.48
// HLC: 26, 40, 46
// LRV:  Approx. 11
$osha-safety-red-hex: #9E3C3F !default; // Hex
$osha-safety-red-cmyk: cmyk(0, 62, 60, 38) !default; // CMYK
$osha-safety-red-rgb: rgb(158, 60, 63) !default; // RGB

// OSHA Safety Red 11105
// Lab: 39.72, 42.51, 19.83
// HLC: 25, 40, 47
// LRV:  Approx. 11
$dot-hwy-red-1-hex: #9F3B40 !default; // HEX
$dot-hwy-red-1-cmyk: cmyk(0, 63, 60, 38) !default; // CMYK
$dot-hwy-red-1-rgb: rgb(159, 59, 64) !default; // RGB

// OSHA Safety Red 11120
// Lab: 44.23, 45.38, 24.51
// HLC: 28, 44, 52
// LRV:  Approx. 14
$osha-safety-red-2-hex: #B04343 !default; // Hex
$osha-safety-red-2-cmyk: cmyk(0, 62, 62, 31) !default; // CMYK
$osha-safety-red-2-rgb: rgb(176, 67, 67) !default; // RGB

// OSHA Safety Orange 12246
// Lab: 54.43, 46.52, 42.05
// HLC: 42, 54, 63
// LRV:  Approx. 22
$osha-safety-orange-hex: #D35C3C !default; // Hex
$osha-safety-orange-cmyk: cmyk(0, 56, 72, 17) !default; // CMYK
$osha-safety-orange-rgb: rgb(211, 92, 60) !default; // RGB

// OSHA Safety Orange 12300
// Lab: 61.85, 34.4, 55.26
// HLC: 58, 62, 65
// LRV:  Approx. 30
$osha-safety-orange-1-hex: #DB7B31 !default; // Hex
$osha-safety-orange-1-cmyk: cmyk(0, 44, 78, 14) !default; // CMYK
$osha-safety-orange-1-rgb: rgb(219, 123, 49) !default; // RGB

// OSHA Safety Yellow 13591
// Lab: 80.38, 5.19, 70.74
// HLC: 86, 80, 71
// LRV:  Approx. 57
$osha-safety-yellow-hex: #EBC235 !default; // Hex
$osha-safety-yellow-cmyk: cmyk(0, 17, 77, 8) !default; // CMYK
$osha-safety-yellow-rgb: rgb(235, 194, 53) !default; // RGB

// OSHA Safety Yellow ANA 505 13655
// Lab: 77.91, 16.14, 76.94
// HLC: 78, 78, 79
// LRV:  Approx. 53
$osha-safety-yellow-505-hex: #F5B417 !default; // Hex
$osha-safety-yellow-505-cmyk: cmyk(0, 27, 91, 4) !default; // CMYK
$osha-safety-yellow-505-rgb: rgb(245, 180, 23) !default; // RGB

// OSHA Safety Green 14120
// Lab: 46.27, -36.2, 7.71
// HLC: 168, 46, 37
// LRV:  Approx. 15
$osha-safety-green-hex: #087D5F !default; // Hex
$osha-safety-green-cmyk: cmyk(94, 0, 24, 51) !default; // CMYK
$osha-safety-green-rgb: rgb(8, 125, 95) !default; // RGB

// OSHA Safety Green 14260
// Lab: 59.52, -22.99, 9.88
// HLC: 157, 60, 25
// LRV:  Approx. 28
$osha-safety-green-1-hex: #679B7D !default; // Hex
$osha-safety-green-1-cmyk: cmyk(34, 0, 19, 39) !default; // CMYK
$osha-safety-green-1-rgb: rgb(103, 155, 125) !default; // RGB

// OSHA Safety Blue 15092
// Lab: 47.59, -13.5, -29.59
// HLC: 245, 48, 33
// LRV:  Approx. 16
$osha-safety-blue-hex: #2C79A2 !default; // Hex
$osha-safety-blue-cmyk: cmyk(73, 25, 0, 36) !default; // CMYK
$osha-safety-blue-rgb: rgb(44, 121, 162) !default; // RGB

// OSHA Safety Blue 15102
// Lab: 42.33, -7.07, -26.16
// HLC: 255, 42, 27
// LRV:  Approx. 13
$osha-safety-blue-1-hex: #3B698F !default; // Hex
$osha-safety-blue-1-cmyk: cmyk(59, 27, 0, 44) !default; // CMYK
$osha-safety-blue-1-rgb: rgb(59, 105, 143) !default; // RGB

// OSHA Safety Black ANA 515/622 17038
// Lab: 24.23, 0.05, -0.14
// HLC: 290, 24, 0
// LRV:  Approx. 4
$osha-safety-black-hex: #3A3A3A !default; // Hex
$osha-safety-black-cmyk: cmyk(0, 0, 0, 77) !default; // CMYK
$osha-safety-black-rgb: rgb(58, 58, 58) !default; // RGB

// OSHA Safety Purple 17142
// Lab: 46.9, 27.29, -11.34
// HLC: 337, 47, 30
// LRV:  Approx. 16
$osha-safety-purple-hex: #945E83 !default; // Hex
$osha-safety-purple-cmyk: cmyk(0, 36, 11, 42) !default; // CMYK
$osha-safety-purple-rgb: rgb(148, 94, 131) !default; // RGB

// OSHA Safety Purple 17155
// Lab: 48.46, 23.8, -15.91
// HLC: 326, 48, 29
// LRV:  Approx. 17
$osha-safety-purple-1-hex: #91648F !default; // Hex
$osha-safety-purple-1-cmyk: cmyk(0, 31, 1, 43) !default; // CMYK
$osha-safety-purple-1-rgb: rgb(145, 100, 143) !default; // RGB

//////////////////////
// Coast Guard Colors

// Coast Guard Deck Red 10076
// Lab: 35.83, 21.82, 13.47
// HLC: 32, 36, 26
// LRV:  Approx. 9
$coast-guard-deck-red-hex: #794640 !default; // Hex
$coast-guard-deck-red-cmyk: cmyk(0, 42, 47, 53) !default; // CMYK
$coast-guard-deck-red-rgb: rgb(121, 70, 64) !default; // RGB

// Coast Guard Buoy Red 11350
// Lab: 42.98, 46.26, 22.54
// HLC: 26, 43, 51
// LRV:  Approx. 13
$coast-guard-buoy-red-hex: #AD3E43 !default; // Hex
$coast-guard-buoy-red-cmyk: cmyk(0, 64, 61, 32) !default; // CMYK
$coast-guard-buoy-red-rgb: rgb(173, 62, 67) !default; // RGB

// Coast Guard Red 12199
// Lab: 52.42, 57.78, 40.51
// HLC: 35, 52, 71
// LRV:  Approx. 21
$coast-guard-red-hex: #DB473C !default; // Hex
$coast-guard-red-cmyk: cmyk(0, 68, 73, 14) !default; // CMYK
$coast-guard-red-rgb: rgb(219, 71, 60) !default; // RGB

// Coast Guard Orange 12250
// Lab: 51.96, 51.85, 41.07
// HLC: 38, 52, 66
// LRV:  Approx. 20
$coast-guard-orange-hex: #D24F39 !default; // Hex
$coast-guard-orange-cmyk: cmyk(0, 62, 73, 18) !default; // CMYK
$coast-guard-orange-rgb: rgb(210, 79, 57) !default; // RGB

// Coast Guard Blue 15182
// Lab: 52.09, -16.22, -28.36
// HLC: 240, 52, 33
// LRV:  Approx. 20
$coast-guard-blue-hex: #3286AC !default; // Hex
$coast-guard-blue-cmyk: cmyk(71, 22, 0, 33) !default; // CMYK
$coast-guard-blue-rgb: rgb(50, 134, 172) !default; // RGB

// Coast Guard Deck Gray 16076
// Lab: 40.66, -0.8, -4.6
// HLC: 260, 41, 5
// LRV:  Approx. 12
$coast-guard-deck-gray-hex: #5C6067 !default; // Hex
$coast-guard-deck-gray-cmyk: cmyk(11, 7, 0, 60) !default; // CMYK
$coast-guard-deck-gray-rgb: rgb(92, 96, 103) !default; // RGB

// Coast Guard Blue Gray 16099
// Lab: 41.07, -2.25, -3.34
// HLC: 236, 41, 4
// LRV:  Approx. 12
$coast-guard-blue-gray-hex: #5B6266 !default; // Hex
$coast-guard-blue-gray-cmyk: cmyk(11, 4, 0, 60) !default; // CMYK
$coast-guard-blue-gray-rgb: rgb(91, 98, 102) !default; // RGB

// Coast Guard White 17860
// Lab: 91.81, -1.63, 4.45
// HLC: 110, 92, 5
// LRV:  Approx. 80
$coast-guard-white-hex: #E7E8DF !default; // Hex
$coast-guard-white-cmyk: cmyk(0, 0, 4, 9) !default; // CMYK
$coast-guard-white-rgb: rgb(231, 232, 223) !default; // RGB

// Coast Guard White 17877
// Lab: 93.52, -4.55, 2.85
// HLC: 148, 94, 5
// LRV:  Approx. 84
$coast-guard-white-1-hex: #E5EFE7 !default; // Hex
$coast-guard-white-1-cmyk: cmyk(4, 0, 3, 6) !default; // CMYK
$coast-guard-white-1-rgb: rgb(229, 239, 231) !default; // RGB

//////////////////////
// NASA Colors

// NASA Safety Brown 10080
// Lab: 36.06, 5.69, 8.63
// HLC: 57, 36, 10
// LRV:  Approx. 9
$nasa-safety-brown-hex: #625147 !default; // Hex
$nasa-safety-brown-cmyk: cmyk(0, 17, 28, 62) !default; // CMYK
$nasa-safety-brown-rgb: rgb(98, 81, 71) !default; // RGB

// NASA Safety Green 14110
// Lab: 41.6, -21.91, 15.34
// HLC: 145, 42, 27
// LRV:  Approx. 12
$nasa-safety-green-hex: #416C48 !default; // Hex
$nasa-safety-green-cmyk: cmyk(40, 0, 33, 58) !default; // CMYK
$nasa-safety-green-rgb: rgb(65, 108, 72) !default; // RGB

// NASA Aircraft Gray 16473
// Lab: 69.3, -4.13, 0.52
// HLC: 173, 69, 4
// LRV:  Approx. 40
$nasa-aircraft-gray-hex: #A2ACA8 !default; // Hex
$nasa-aircraft-gray-cmyk: cmyk(6, 0, 2, 33) !default; // CMYK
$nasa-aircraft-gray-rgb: rgb(162, 172, 168) !default; // RGB

//////////////////////
// National Parks Service Colors

// National Parks Service Cocoa Brown 10233
// Lab: 53.74, 16.21, 13.07
// HLC: 39, 54, 21
// LRV:  Approx. 22
$nps-cocoa-brown-hex: #A1766B !default; // Hex
$nps-cocoa-brown-cmyk: cmyk(0, 27, 34, 37) !default; // CMYK
$nps-cocoa-brown-rgb: rgb(161, 118, 107) !default; // RGB

// National Parks Service Cream 13690
// Lab: 83.6, 2.78, 17.84
// HLC: 81, 84, 18
// LRV:  Approx. 63
$nps-cream-hex: #E0CEAF !default; // Hex
$nps-cream-cmyk: cmyk(0, 8, 22, 12) !default; // CMYK
$nps-cream-rgb: rgb(224, 206, 175) !default; // RGB

// National Parks Service Ivory 13695
// Lab: 83.02, 6.55, 39.09
// HLC: 80, 83, 40
// LRV:  Approx. 62
$nps-ivory-hex: #EDC985 !default; // Hex
$nps-ivory-cmyk: cmyk(0, 15, 44, 7) !default; // CMYK
$nps-ivory-rgb: rgb(237, 201, 133) !default; // RGB

//////////////////////
// Post Office Colors

// Post Office Red 11310
// Lab: 45.7, 47.23, 27.63
// HLC: 30, 46, 55
// LRV:  Approx. 15
$post-office-red-hex: #B74441 !default; // Hex
$post-office-red-cmyk: cmyk(0, 63, 64, 28) !default; // CMYK
$post-office-red-rgb: rgb(183, 68, 65) !default; // RGB

// Post Office Yellow 13275
// Lab: 59.29, 15.8, 46.59
// HLC: 71, 59, 49
// LRV:  Approx. 27
$post-office-yellow-hex: #B8833A !default; // Hex
$post-office-yellow-cmyk: cmyk(0, 29, 68, 28) !default; // CMYK
$post-office-yellow-rgb: rgb(184, 131, 58) !default; // RGB

// Post Office Cream 13618
// Lab: 81.04, 5.15, 49.97
// HLC: 84, 81, 50
// LRV:  Approx. 59
$post-office-cream-hex: #E8C469 !default; // Hex
$post-office-cream-cmyk: cmyk(0, 16, 55, 9) !default; // CMYK
$post-office-cream-rgb: rgb(232, 196, 105) !default; // RGB

// Post Office Dark Blue 15048
// Lab: 30.69, -1.17, -12.99
// HLC: 265, 31, 13
// LRV:  Approx. 7
$post-office-dark-blue-hex: #3D495C !default; // Hex
$post-office-dark-blue-cmyk: cmyk(34, 21, 0, 64) !default; // CMYK
$post-office-dark-blue-rgb: rgb(61, 73, 92) !default; // RGB

// Post Office Medium Blue 15052
// Lab: 34.04, -0.99, -22.94
// HLC: 268, 34, 23
// LRV:  Approx. 8
$post-office-medium-blue-hex: #3B5274 !default; // Hex
$post-office-medium-blue-cmyk: cmyk(49, 29, 0, 55) !default; // CMYK
$post-office-medium-blue-rgb: rgb(59, 82, 116) !default; // RGB

// Post Office Light Blue 15095
// Lab: 44.16, -1.9, -37.15
// HLC: 267, 44, 37
// LRV:  Approx. 14
$post-office-light-blue-hex: #3C6BA6 !default; // Hex
$post-office-light-blue-cmyk: cmyk(64, 36, 0, 35) !default; // CMYK
$post-office-light-blue-rgb: rgb(60, 107, 166) !default; // RGB

// Post Office Box 15050
// Lab: 32.03, -1.88, -14.32
// HLC: 263, 32, 14
// LRV:  Approx. 7
$post-office-box-hex: #3E4D62 !default; // Hex
$post-office-box-cmyk: cmyk(37, 21, 0, 62) !default; // CMYK
$post-office-box-rgb: rgb(62, 77, 98) !default; // RGB


//////////////////////
// Miscellaneous Colors

// School Bus Yellow 13415
// Lab: 68.9, 23.84, 61.4
// HLC: 69, 69, 66
// LRV:  Approx. 39
$school-bus-yellow-hex: #E39632 !default; // Hex
$school-bus-yellow-cmyk: cmyk(0, 34, 78, 11) !default; // CMYK
$school-bus-yellow-rgb: rgb(227, 150, 50) !default; // RGB

// Oxygen Tank Green ANA 503 14187
// Lab: 47.96, -22.15, 26.68
// HLC: 130, 48, 35
// LRV:  Approx. 17
$oxygen-tank-green-hex: #567C43 !default; // Hex
$oxygen-tank-green-cmyk: cmyk(31, 0, 46, 51) !default; // CMYK
$oxygen-tank-green-rgb: rgb(86, 124, 67) !default; // RGB

// Boeing Gray 707 16515
// Lab: 77.89, -1.71, 1.18
// HLC: 145, 78, 2
// LRV:  Approx. 53
$boeing-gray-707-hex: #BEC1BE !default; // Hex
$boeing-gray-707-cmyk: cmyk(2, 0, 2, 24) !default; // CMYK
$boeing-gray-707-rgb: rgb(190, 193, 190) !default; // RGB

// Navy Mechanic Gray 16187
// Lab: 52.29, -3.09, -1.24
// HLC: 202, 52, 3
// LRV:  Approx. 20
$navy-mechanic-gray-hex: #767E7F !default; // Hex
$navy-mechanic-gray-cmyk: cmyk(7, 1, 0, 50) !default; // CMYK
$navy-mechanic-gray-rgb: rgb(118, 126, 127) !default; // RGB

// Air Force Blue 15045
// Lab: 30.31, -3.09, -7.14
// HLC: 247, 30, 8
// LRV:  Approx. 6
$air-force-blue-hex: #3D4952 !default; // Hex
$air-force-blue-cmyk: cmyk(26, 11, 0, 68) !default; // CMYK
$air-force-blue-rgb: rgb(61, 73, 82) !default; // RGB

// Army Admin Vehicles 14672
// Lab: 83.22, -6.49, 13.08
// HLC: 116, 83, 15
// LRV:  Approx. 63
$army-admin-vehicles-hex: #CBD3B6 !default; // Hex
$army-admin-vehicles-cmyk: cmyk(4, 0, 14, 17) !default; // CMYK
$army-admin-vehicles-rgb: rgb(203, 211, 182) !default; // RGB

// Army Admin Green / NATO Green 14050
// Lab: 33.47, -2, 2.31
// HLC: 131, 33, 3
// LRV:  Approx. 8
$army-green-hex: #4D504B !default; // Hex
$army-green-cmyk: cmyk(4, 0, 6, 69) !default; // CMYK
$army-green-rgb: rgb(77, 80, 75) !default; // RGB

// International Orange 12197
// Lab: 49.34, 45.97, 35.77
// HLC: 38, 49, 58
// LRV:  Approx. 18
$international-orange-hex: #C24F3C !default; // Hex
$international-orange-cmyk: cmyk(0, 59, 69, 24) !default; // CMYK
$international-orange-rgb: rgb(194, 79, 60) !default; // RGB

// Hawker Beechcraft White 17865
// Lab: 90.6, -1.45, 0.72
// HLC: 54, 91, 2
// LRV:  Approx. 78
$hawker-beechcraft-white-hex: #E2E5E3 !default; // Hex
$hawker-beechcraft-white-cmyk: cmyk(1, 0, 1, 10) !default; // CMYK
$hawker-beechcraft-white-rgb: rgb(226, 229, 227) !default; // RGB
            </code>
        </pre>
    </div>
@endsection
