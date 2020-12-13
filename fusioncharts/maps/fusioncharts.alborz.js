(function(factory){if(typeof module==="object"&&typeof module.exports!=="undefined"){module.exports=factory}else{factory(FusionCharts)}})(function(FusionCharts){(function(modules){var installedModules={};function __webpack_require__(moduleId){if(installedModules[moduleId]){return installedModules[moduleId].exports}var module=installedModules[moduleId]={i:moduleId,l:false,exports:{}};modules[moduleId].call(module.exports,module,module.exports,__webpack_require__);module.l=true;return module.exports}__webpack_require__.m=modules;__webpack_require__.c=installedModules;__webpack_require__.d=function(exports,name,getter){if(!__webpack_require__.o(exports,name)){Object.defineProperty(exports,name,{configurable:false,enumerable:true,get:getter})}};__webpack_require__.r=function(exports){Object.defineProperty(exports,"__esModule",{value:true})};__webpack_require__.n=function(module){var getter=module&&module.__esModule?function getDefault(){return module["default"]}:function getModuleExports(){return module};__webpack_require__.d(getter,"a",getter);return getter};__webpack_require__.o=function(object,property){return Object.prototype.hasOwnProperty.call(object,property)};__webpack_require__.p="";return __webpack_require__(__webpack_require__.s=74)})({74:function(module,exports,__webpack_require__){"use strict";var _fusioncharts=__webpack_require__(75);var _fusioncharts2=_interopRequireDefault(_fusioncharts);function _interopRequireDefault(obj){return obj&&obj.__esModule?obj:{"default":obj}}FusionCharts.addDep(_fusioncharts2["default"])},75:function(module,exports,__webpack_require__){"use strict";exports.__esModule=true;
/**!
 * @license FusionCharts JavaScript Library
 * Copyright FusionCharts, Inc.
 * License Information at <http://www.fusioncharts.com/license>
 *
 * @author FusionCharts, Inc.
 * @meta package_map_pack
 * @id fusionmaps.Alborz.1.11-06-2017 03:09:45
 */var M="M",L="L",Z="Z",Q="Q",LFT="left",RGT="right",CEN="center",MID="middle",TOP="top",BTM="bottom",geodefinitions=[{name:"البرز",revision:1,creditLabel:false,standaloneInit:false,baseWidth:600,baseHeight:436,baseScaleFactor:10,firstEntity:"IR.AL.TA",entities:{"IR.AL.TA":{outlines:[[M,2985,157,Q,2977,153,2962,152,2953,151,2925,151,2900,152,2889,149,2875,144,2865,143,2859,142,2833,142,2765,142,2757,139,2740,132,2703,132,2661,133,2648,130,2625,119,2623,119,L,2598,119,Q,2559,120,2544,116,2522,111,2495,109,2468,109,2444,103,2443,102,2421,102,2399,101,2395,99,2374,93,2369,91,2362,89,2349,87,2348,87,2290,78,2273,81,2264,75,2256,69,2249,66,L,2223,66,Q,2212,65,2208,63,L,2194,55,Q,2121,55,2109,50,2090,43,2075,42,2074,42,2034,42,1937,40,1919,41,1915,41,1915,42,1814,43,1775,42,1752,40,1723,50,1708,54,1704,55,1690,55,1680,58,L,1559,58,Q,1557,58,1534,64,1520,67,1508,67,1505,67,1475,66,1457,65,1448,67,1445,68,1417,76,1399,81,1387,79,1378,78,1361,84,1345,89,1341,89,1320,91,1298,101,1271,112,1256,132,1250,138,1250,149,1250,153,1247,159,1245,164,1244,170,1242,179,1242,220,L,1242,266,Q,1243,279,1250,288,1252,291,1252,300,1251,311,1252,315,1254,322,1259,335,1263,347,1264,355,1264,363,1269,375,1275,388,1282,392,1288,413,1290,421,1292,430,1295,438,1299,445,1303,452,1316,471,1321,490,1325,504,1329,512,1332,517,1342,533,1347,540,1364,579,1374,601,1392,617,1420,641,1439,653,1457,666,1470,674,1476,678,1484,683,1499,692,1514,701,1517,703,1520,705,1528,710,1532,712,1539,717,1558,725,L,1623,757,Q,1637,764,1652,772,L,1673,780,Q,1678,784,1684,787,1691,790,1717,804,1743,817,1757,825,1771,832,1794,841,1816,849,1825,854,1844,863,1892,882,1909,891,1955,910,1991,925,2013,937,2045,945,2101,973,2144,994,2151,998,2176,1011,2198,1028,2224,1048,2237,1064,2248,1077,2263,1105,2273,1123,2275,1127,2282,1142,2281,1151,2276,1185,2294,1201,2295,1201,2295,1202,L,2295,1234,Q,2295,1237,2292,1246,2288,1255,2287,1261,2286,1266,2285,1280,2285,1294,2282,1309,2279,1317,2275,1331,2282,1335,2297,1334,2303,1333,2308,1335,2311,1336,2321,1342,2325,1344,2333,1344,2338,1345,2347,1345,2352,1346,2364,1353,2371,1354,2405,1353,2431,1352,2443,1359,2450,1362,2473,1365,2484,1365,2499,1371,2517,1375,2536,1377,2551,1379,2564,1383,L,2614,1397,Q,2626,1396,2640,1399,2648,1401,2663,1404,2691,1409,2693,1409,2700,1411,2711,1416,L,2720,1419,2731,1420,Q,2749,1420,2771,1425,2790,1430,2840,1430,2846,1430,2851,1430,2988,1428,2988,1428,2997,1428,3008,1435,3018,1441,3023,1441,L,3037,1440,Q,3046,1440,3049,1442,3055,1446,3062,1448,3064,1449,3066,1449,L,3080,1449,Q,3085,1450,3096,1455,3105,1460,3127,1462,3131,1463,3141,1467,3151,1471,3161,1472,3172,1472,3183,1477,3193,1482,3200,1482,3201,1482,3240,1482,3283,1482,3302,1481,3305,1481,3309,1478,3316,1475,3326,1471,3339,1467,3353,1465,3356,1463,3361,1463,3367,1462,3375,1459,3377,1459,3381,1456,3385,1454,3390,1452,3405,1448,3428,1446,3436,1444,3463,1436,3464,1435,3479,1433,3492,1431,3496,1429,3502,1426,3514,1423,3525,1421,3528,1419,3535,1419,3545,1417,3554,1414,3577,1407,L,3640,1390,Q,3660,1386,3759,1350,L,3807,1326,Q,3816,1324,3835,1318,3852,1313,3864,1315,3897,1319,3980,1304,3981,1304,3983,1304,3992,1303,4009,1302,4027,1300,4034,1301,4044,1302,4059,1298,4076,1293,4088,1293,4099,1293,4106,1291,4107,1291,4116,1286,4122,1283,4129,1282,4142,1281,4143,1281,4159,1275,4175,1271,L,4198,1260,Q,4211,1252,4234,1240,4259,1226,4297,1205,4305,1199,4318,1192,4323,1187,4333,1185,4338,1184,4346,1182,4353,1179,4359,1175,4362,1174,4371,1173,4371,1173,4378,1172,4382,1172,4386,1169,4388,1168,4390,1167,4391,1166,4392,1166,4395,1165,4396,1164,L,4415,1164,Q,4418,1166,4426,1166,4430,1166,4438,1166,4448,1166,4459,1160,4462,1158,4469,1157,4482,1155,4484,1154,4501,1150,4529,1137,4565,1120,4574,1118,4586,1115,4613,1098,4626,1089,4653,1072,4675,1058,4684,1047,4686,1045,4693,1040,4700,1036,4703,1033,L,4715,1020,Q,4728,1e3,4738,993,4733,991,4728,989,4713,983,4682,979,4651,974,4623,966,4594,958,4584,953,4574,949,4561,946,4554,944,4540,940,4525,934,4516,931,4507,927,4502,925,4490,921,4482,921,4470,920,4458,914,4448,910,4439,911,4432,911,4407,903,4382,895,4378,892,4344,880,4319,873,4282,861,4246,846,4233,840,4205,832,4180,824,4162,816,4120,798,4090,785,4060,773,4041,763,4021,753,3993,737,3964,721,3941,706,3917,691,3904,677,3891,662,3866,650,3860,646,3853,640,3846,633,3835,628,3824,623,3813,614,L,3791,601,Q,3784,596,3763,585,3739,574,3699,550,L,3654,521,Q,3641,512,3598,487,3553,462,3544,458,3534,454,3513,441,3494,429,3490,428,L,3447,406,Q,3436,401,3413,387,3385,371,3369,364,3347,354,3319,339,3288,322,3271,313,3251,303,3229,289,3220,283,3190,269,L,3095,220,Q,3073,209,3072,208,3051,196,3044,192,3036,187,3012,173,Q,2988,159,2985,157,Z]],label:"Taleghan County",shortLabel:"TA",labelPosition:[286,76.1],labelAlignment:[CEN,MID],nextId:"IR.AL.KA"},"IR.AL.KA":{outlines:[[M,5535,1112,L,5419,1112,Q,5412,1110,5399,1106,5386,1100,5364,1098,L,5284,1096,Q,5260,1089,5256,1089,5225,1088,5219,1089,5210,1090,5192,1085,5171,1079,5157,1079,L,5129,1079,Q,5117,1077,5108,1073,5098,1069,5087,1068,5065,1067,5062,1066,5039,1063,5034,1061,5024,1056,5009,1058,4998,1059,4989,1055,4980,1050,4971,1049,4954,1051,4935,1046,4914,1039,4907,1037,4901,1034,4893,1033,4884,1032,4873,1029,4846,1024,4836,1020,4828,1017,4814,1014,4798,1012,4794,1010,4761,998,4755,997,4748,995,4738,993,4728,1e3,4715,1020,L,4703,1033,Q,4700,1036,4693,1040,4686,1045,4684,1047,4675,1058,4653,1072,4626,1089,4613,1098,4586,1115,4574,1118,4565,1120,4529,1137,4501,1150,4484,1154,4482,1155,4469,1157,4462,1158,4459,1160,4448,1166,4438,1166,4430,1166,4426,1166,4418,1166,4415,1164,L,4396,1164,Q,4395,1165,4392,1166,4391,1166,4390,1167,4388,1168,4386,1169,4382,1172,4378,1172,4371,1173,4371,1173,4362,1174,4359,1175,4353,1179,4346,1182,4338,1184,4333,1185,4323,1187,4318,1192,4305,1199,4297,1205,4259,1226,4234,1240,4234,1280,4233,1288,4232,1296,4229,1305,4225,1314,4226,1342,4226,1374,4224,1383,4218,1395,4219,1401,4219,1407,4219,1419,4219,1431,4220,1441,4221,1451,4221,1469,4220,1484,4223,1487,4226,1494,4238,1519,4249,1545,4256,1557,4256,1561,4256,1568,4256,1575,4258,1579,L,4266,1604,Q,4266,1607,4272,1619,4276,1629,4276,1632,4275,1642,4276,1664,L,4276,1702,Q,4275,1704,4274,1718,4265,1730,4264,1734,4263,1740,4259,1748,L,4252,1763,Q,4249,1770,4242,1776,4232,1784,4230,1789,L,4208,1802,Q,4204,1805,4196,1811,4188,1817,4184,1819,4177,1821,4171,1821,4167,1821,4164,1823,4158,1826,4156,1826,4150,1827,4142,1827,4133,1827,4127,1828,4118,1829,4100,1837,4097,1839,4085,1838,4073,1838,4068,1839,4049,1848,4042,1848,4030,1848,4022,1860,L,4004,1883,Q,3999,1887,3997,1894,3995,1897,3992,1905,3990,1909,3981,1917,3974,1922,3976,1927,3973,1934,3972,1955,3973,1959,3968,1968,3961,1979,3961,1982,3960,1983,3960,1998,3959,2010,3957,2014,3954,2017,3949,2027,3945,2035,3941,2038,3933,2043,3929,2046,3920,2051,3917,2051,L,3897,2051,Q,3893,2051,3889,2053,3883,2056,3879,2058,3867,2061,3856,2061,3838,2061,3835,2061,3822,2071,3811,2070,3799,2069,3791,2074,3774,2083,3768,2086,3759,2091,3753,2098,3744,2107,3736,2120,3727,2134,3725,2138,3719,2144,3704,2154,3692,2162,3688,2169,3675,2189,3651,2205,3625,2220,3615,2226,3598,2237,3575,2248,3566,2250,3563,2251,3558,2253,3554,2258,3550,2265,3548,2267,3545,2270,3541,2270,L,3495,2270,Q,3489,2270,3484,2272,3476,2275,3468,2278,3465,2279,3455,2280,3446,2280,3444,2282,L,3424,2292,Q,3415,2293,3411,2294,3403,2295,3399,2298,3374,2315,3371,2334,3369,2342,3370,2357,3371,2376,3370,2382,3369,2392,3362,2401,3350,2415,3347,2421,3323,2460,3318,2465,3310,2473,3305,2488,3304,2491,3298,2500,3294,2506,3293,2511,3293,2513,3294,2522,3294,2528,3291,2533,3284,2544,3284,2554,L,3284,2578,Q,3284,2582,3279,2588,3272,2596,3271,2599,3268,2606,3242,2634,3222,2655,3222,2678,3222,2690,3223,2693,3224,2697,3231,2706,3232,2707,3245,2730,3248,2733,3256,2736,3267,2741,3270,2743,3277,2746,3299,2746,3304,2746,3313,2747,3321,2749,3325,2751,L,3355,2755,Q,3389,2760,3402,2779,3402,2779,3403,2780,3403,2808,3398,2812,3393,2815,3390,2819,3388,2822,3377,2828,3366,2834,3345,2849,3339,2853,3327,2864,3317,2874,3309,2878,3301,2882,3291,2894,3280,2910,3273,2917,3262,2929,3248,2954,3228,2993,3224,2998,3210,3029,3202,3042,3189,3063,3173,3063,L,3170,3063,3082,3059,Q,3042,3059,3033,3065,3e3,3086,2996,3088,2993,3090,2967,3093,2942,3096,2919,3093,2908,3094,2903,3090,2898,3085,2896,3083,2892,3082,2880,3081,2868,3081,2868,3081,2860,3079,2856,3076,2852,3074,2847,3074,L,2811,3075,Q,2807,3075,2803,3079,2801,3081,2798,3084,2793,3086,2783,3091,2772,3097,2768,3102,2765,3103,2753,3108,L,2717,3123,Q,2716,3123,2683,3135,2673,3139,2669,3140,2663,3142,2656,3146,2627,3165,2624,3169,2622,3173,2622,3195,2622,3212,2623,3215,2624,3220,2635,3234,2638,3239,2647,3252,2655,3262,2665,3267,2667,3269,2673,3280,2678,3291,2684,3296,2693,3306,2695,3312,2696,3315,2696,3327,2696,3349,2694,3356,2691,3364,2672,3386,2668,3390,2658,3400,2649,3409,2645,3416,2644,3417,2630,3435,2628,3437,2628,3449,2628,3468,2631,3503,L,2661,3503,Q,2673,3498,2688,3498,L,2689,3499,Q,2691,3499,2704,3498,2705,3498,2708,3498,2714,3498,2720,3496,L,2950,3496,Q,2951,3496,2953,3496,2987,3494,3e3,3495,3016,3495,3049,3488,3083,3481,3096,3482,3127,3484,3187,3483,3197,3483,3205,3483,3199,3478,3199,3471,3199,3460,3195,3454,3184,3446,3182,3443,3177,3438,3179,3427,3180,3422,3175,3409,3171,3397,3170,3394,3161,3369,3161,3366,3166,3352,3166,3346,L,3166,3331,Q,3167,3325,3171,3320,3177,3316,3179,3312,3183,3301,3192,3288,3199,3277,3205,3272,3208,3269,3217,3257,3225,3246,3232,3240,3235,3238,3246,3227,3255,3217,3259,3214,3284,3194,3290,3188,3301,3176,3319,3161,L,3350,3134,Q,3360,3124,3384,3105,3412,3076,3433,3043,3433,3041,3433,3039,3434,3035,3437,3030,3440,3026,3446,3018,3450,3011,3460,2995,L,3496,2945,Q,3501,2937,3515,2924,3529,2911,3535,2908,3540,2905,3549,2905,3560,2905,3561,2905,3569,2902,3576,2902,3580,2902,3589,2902,3600,2902,3621,2925,L,3652,2951,Q,3667,2964,3682,2983,3692,2994,3701,2998,3707,3e3,3719,3e3,3743,3e3,3759,2994,3774,2987,3784,2987,L,3786,2987,Q,3790,2987,3804,2987,3826,2987,3832,2988,3835,2988,3844,3002,3853,3013,3854,3014,3856,3016,3858,3021,3860,3027,3862,3030,3864,3035,3864,3044,L,3864,3071,Q,3865,3091,3864,3097,3863,3103,3863,3121,3862,3138,3864,3153,3866,3168,3866,3192,3866,3196,3870,3204,3874,3213,3875,3220,3875,3225,3881,3237,3886,3247,3889,3250,3925,3282,3938,3291,3968,3313,3995,3322,3996,3321,3997,3320,4e3,3317,4002,3316,4005,3309,4010,3305,4011,3305,4025,3295,4030,3290,4044,3272,4055,3262,4066,3247,4072,3239,4084,3223,4096,3208,4103,3196,4107,3189,4118,3168,L,4148,3121,Q,4164,3080,4167,3072,4186,3037,4189,3030,4193,3020,4210,2987,4224,2958,4224,2948,4227,2937,4237,2921,L,4251,2893,Q,4270,2847,4278,2835,4281,2832,4305,2793,4309,2786,4320,2772,4328,2763,4332,2757,4333,2756,4335,2754,4346,2741,4369,2713,4393,2685,4407,2673,4422,2660,4449,2637,4472,2618,4492,2603,4498,2598,4525,2577,4555,2553,4568,2538,4586,2519,4607,2501,4619,2492,4638,2479,L,4638,2479,4749,2400,Q,4792,2371,4805,2366,4824,2359,4837,2356,4843,2354,4850,2350,4856,2346,4863,2346,4885,2344,4889,2342,4899,2336,4901,2335,4906,2334,4917,2333,4934,2332,4957,2332,4960,2332,4968,2329,4976,2326,4981,2326,4993,2326,5002,2330,5012,2334,5028,2335,5036,2336,5057,2335,5074,2335,5081,2339,5091,2345,5110,2347,5120,2348,5135,2349,5135,2349,5143,2352,5151,2355,5154,2355,L,5181,2354,Q,5186,2354,5192,2358,5199,2361,5205,2361,5208,2361,5229,2366,5231,2366,5241,2367,5247,2368,5250,2370,5254,2371,5262,2375,5269,2375,5273,2376,5275,2376,5275,2377,L,5335,2377,Q,5337,2377,5349,2382,5359,2385,5361,2386,5366,2389,5379,2389,5379,2391,5394,2389,5410,2386,5424,2381,5432,2377,5444,2376,5451,2375,5466,2374,L,5486,2372,Q,5487,2372,5493,2369,5500,2366,5503,2367,5515,2367,5522,2364,5527,2362,5532,2358,5593,2327,5617,2275,5626,2253,5630,2247,5632,2245,5636,2233,5640,2221,5642,2217,5644,2215,5645,2202,5646,2191,5651,2186,5655,2180,5655,2161,5662,2143,5665,2136,5670,2122,5669,2111,5668,2101,5672,2088,5676,2073,5678,2064,5682,2054,5697,2020,5706,1999,5710,1985,5710,1984,5710,1982,5711,1978,5714,1973,5716,1970,5720,1964,5722,1957,5728,1943,5739,1912,5748,1894,5757,1876,5773,1850,5781,1836,5794,1816,5795,1815,5796,1813,5802,1801,5816,1779,5828,1756,5835,1740,5840,1728,5857,1701,5874,1674,5878,1667,L,5878,1655,Q,5878,1651,5879,1648,5880,1645,5886,1636,5889,1631,5889,1624,5889,1617,5889,1614,5889,1605,5892,1594,5894,1584,5898,1577,5900,1572,5901,1558,5901,1544,5903,1542,5909,1527,5911,1523,5913,1514,5911,1506,5911,1472,5917,1465,5922,1457,5922,1440,5922,1429,5920,1420,5919,1411,5919,1407,5919,1405,5923,1392,5927,1380,5929,1374,5934,1362,5934,1339,5934,1325,5937,1310,5941,1289,5942,1284,L,5941,1260,Q,5941,1241,5943,1233,5943,1232,5945,1229,5948,1226,5949,1223,L,5950,1213,Q,5950,1209,5954,1205,L,5955,1153,Q,5944,1154,5933,1148,5921,1143,5915,1144,5897,1145,5888,1141,5880,1137,5870,1135,5856,1131,5810,1134,5805,1134,5790,1129,5774,1125,5768,1124,L,5597,1124,Q,5588,1123,5584,1121,L,5567,1123,Q,5567,1127,5535,1112,Z]],label:"Karaj County",shortLabel:"KA",labelPosition:[494.1,172.6],labelAlignment:[CEN,MID],nextId:"IR.AL.SA"},"IR.AL.SA":{outlines:[[M,3428,1446,Q,3405,1448,3390,1452,3385,1454,3381,1456,3377,1459,3375,1459,3367,1462,3361,1463,3356,1463,3353,1465,3339,1467,3326,1471,3316,1475,3309,1478,3305,1481,3302,1481,3283,1482,3240,1482,3201,1482,3200,1482,3193,1482,3183,1477,3172,1472,3161,1472,3151,1471,3141,1467,3131,1463,3127,1462,3105,1460,3096,1455,3085,1450,3080,1449,L,3066,1449,Q,3064,1449,3062,1448,3055,1446,3049,1442,3046,1440,3037,1440,L,3023,1441,Q,3018,1441,3008,1435,2997,1428,2988,1428,2988,1428,2851,1430,2846,1430,2840,1430,2790,1430,2771,1425,2749,1420,2731,1420,L,2720,1419,2711,1416,Q,2700,1411,2693,1409,2691,1409,2663,1404,2648,1401,2640,1399,2626,1396,2614,1397,L,2564,1383,Q,2551,1379,2536,1377,2517,1375,2499,1371,2484,1365,2473,1365,2450,1362,2443,1359,2431,1352,2405,1353,2371,1354,2364,1353,2352,1346,2347,1345,2338,1345,2333,1344,2325,1344,2321,1342,2311,1336,2308,1335,2303,1333,2297,1334,2282,1335,2275,1331,2272,1339,2268,1350,2259,1377,2253,1391,2246,1404,2245,1406,2241,1414,2234,1425,2225,1445,2224,1447,2221,1452,2205,1464,2188,1477,2184,1480,2167,1494,2160,1499,2149,1507,2136,1512,2119,1518,2109,1526,2090,1541,2085,1544,2056,1562,2031,1575,2008,1586,1990,1593,1975,1598,1963,1605,1944,1616,1897,1634,1854,1651,1839,1658,1838,1659,1837,1659,1826,1662,1812,1667,1790,1675,1786,1676,1780,1678,1773,1681,1776,1684,1779,1687,1782,1690,1783,1698,L,1796,1711,Q,1797,1712,1807,1727,1814,1737,1820,1739,1824,1748,1827,1752,1835,1763,1838,1768,1843,1773,1848,1782,1854,1793,1857,1797,1863,1805,1884,1820,1890,1824,1897,1826,1907,1828,1913,1831,1917,1832,1929,1835,1939,1837,1946,1842,1949,1844,1953,1847,1957,1849,1962,1849,1968,1849,1977,1856,L,2011,1869,Q,2013,1869,2018,1870,2021,1870,2024,1873,2025,1873,2030,1878,2036,1883,2039,1883,2040,1883,2059,1872,2061,1871,2064,1864,2068,1857,2071,1856,2081,1850,2082,1841,2083,1830,2085,1827,2093,1814,2098,1809,2107,1800,2116,1798,2120,1797,2123,1794,2124,1792,2129,1788,2133,1783,2148,1783,2157,1783,2159,1785,2165,1790,2172,1793,2184,1798,2200,1812,2218,1825,2218,1836,2218,1844,2225,1849,2234,1857,2235,1859,2237,1864,2256,1886,2258,1890,2260,1899,2262,1904,2267,1909,2273,1921,2273,1922,2277,1925,2286,1924,2292,1923,2293,1933,2294,1934,2301,1934,2305,1934,2305,1938,L,2304,1939,Q,2296,1942,2293,1943,2288,1945,2281,1949,2276,1952,2277,1964,2277,1971,2278,1982,2278,1987,2295,2001,2313,2016,2317,2022,2320,2023,2324,2023,2326,2023,2328,2023,2336,2023,2339,2022,2344,2020,2351,2013,2353,2010,2363,2005,2365,2003,2366,1999,2367,1997,2371,1997,2389,1997,2393,2e3,2399,2004,2399,2024,2399,2043,2392,2056,2384,2070,2379,2080,2374,2089,2371,2097,2368,2104,2367,2118,2366,2130,2367,2141,2367,2152,2369,2153,2369,2154,2372,2155,2377,2157,2385,2161,2398,2163,2419,2163,2442,2162,2447,2163,2457,2163,2477,2174,2484,2178,2494,2178,2498,2179,2501,2183,2503,2186,2508,2191,2524,2209,2527,2214,2534,2224,2534,2240,L,2533,2256,2527,2270,2528,2286,Q,2526,2299,2521,2303,2517,2306,2516,2309,2514,2313,2514,2320,2514,2327,2509,2338,2505,2347,2506,2354,2506,2358,2503,2361,2500,2362,2493,2366,2489,2368,2485,2373,2479,2380,2476,2383,2474,2383,2467,2386,2462,2389,2458,2393,2458,2394,2447,2406,2442,2411,2441,2414,2438,2426,2435,2430,2430,2434,2427,2436,2422,2441,2420,2448,2419,2451,2413,2455,2407,2459,2405,2462,2399,2472,2399,2479,2399,2483,2396,2487,2391,2492,2391,2493,2389,2494,2389,2501,2389,2504,2389,2514,2388,2524,2379,2531,2370,2539,2367,2550,L,2367,2550,Q,2368,2673,2368,2692,2367,2711,2367,2725,2367,2739,2360,2753,2356,2758,2354,2769,2353,2782,2352,2784,2344,2798,2344,2799,L,2338,2814,Q,2336,2820,2330,2830,2325,2839,2325,2845,2327,2846,2330,2847,2336,2850,2341,2851,2344,2851,2351,2851,2353,2851,2355,2852,2359,2855,2360,2856,2364,2859,2370,2861,2379,2866,2394,2873,2403,2879,2420,2886,2444,2901,2446,2902,2452,2905,2470,2905,2488,2905,2496,2898,2505,2892,2517,2892,2525,2892,2530,2893,L,2652,2893,Q,2654,2894,2666,2899,2678,2903,2686,2902,2696,2901,2705,2906,2715,2911,2721,2912,2732,2914,2746,2927,2752,2931,2773,2952,L,2796,2977,Q,2801,2981,2803,2993,2804,3005,2807,3008,2812,3018,2812,3039,2812,3051,2812,3075,L,2847,3074,Q,2852,3074,2856,3076,2860,3079,2868,3081,2868,3081,2880,3081,2892,3082,2896,3083,2898,3085,2903,3090,2908,3094,2919,3093,2942,3096,2967,3093,2993,3090,2996,3088,3e3,3086,3033,3065,3042,3059,3082,3059,L,3170,3063,3173,3063,Q,3189,3063,3202,3042,3210,3029,3224,2998,3228,2993,3248,2954,3262,2929,3273,2917,3280,2910,3291,2894,3301,2882,3309,2878,3317,2874,3327,2864,3339,2853,3345,2849,3366,2834,3377,2828,3388,2822,3390,2819,3393,2815,3398,2812,3403,2808,3403,2780,3402,2779,3402,2779,3389,2760,3355,2755,L,3325,2751,Q,3321,2749,3313,2747,3304,2746,3299,2746,3277,2746,3270,2743,3267,2741,3256,2736,3248,2733,3245,2730,3232,2707,3231,2706,3224,2697,3223,2693,3222,2690,3222,2678,3222,2655,3242,2634,3268,2606,3271,2599,3272,2596,3279,2588,3284,2582,3284,2578,L,3284,2554,Q,3284,2544,3291,2533,3294,2528,3294,2522,3293,2513,3293,2511,3294,2506,3298,2500,3304,2491,3305,2488,3310,2473,3318,2465,3323,2460,3347,2421,3350,2415,3362,2401,3369,2392,3370,2382,3371,2376,3370,2357,3369,2342,3371,2334,3374,2315,3399,2298,3403,2295,3411,2294,3415,2293,3424,2292,L,3444,2282,Q,3446,2280,3455,2280,3465,2279,3468,2278,3476,2275,3484,2272,3489,2270,3495,2270,L,3541,2270,Q,3545,2270,3548,2267,3550,2265,3554,2258,3558,2253,3563,2251,3566,2250,3575,2248,3598,2237,3615,2226,3625,2220,3651,2205,3675,2189,3688,2169,3692,2162,3704,2154,3719,2144,3725,2138,3727,2134,3736,2120,3744,2107,3753,2098,3759,2091,3768,2086,3774,2083,3791,2074,3799,2069,3811,2070,3822,2071,3835,2061,3838,2061,3856,2061,3867,2061,3879,2058,3883,2056,3889,2053,3893,2051,3897,2051,L,3917,2051,Q,3920,2051,3929,2046,3933,2043,3941,2038,3945,2035,3949,2027,3954,2017,3957,2014,3959,2010,3960,1998,3960,1983,3961,1982,3961,1979,3968,1968,3973,1959,3972,1955,3973,1934,3976,1927,3974,1922,3981,1917,3990,1909,3992,1905,3995,1897,3997,1894,3999,1887,4004,1883,L,4022,1860,Q,4030,1848,4042,1848,4049,1848,4068,1839,4073,1838,4085,1838,4097,1839,4100,1837,4118,1829,4127,1828,4133,1827,4142,1827,4150,1827,4156,1826,4158,1826,4164,1823,4167,1821,4171,1821,4177,1821,4184,1819,4188,1817,4196,1811,4204,1805,4208,1802,L,4230,1789,Q,4232,1784,4242,1776,4249,1770,4252,1763,L,4259,1748,Q,4263,1740,4264,1734,4265,1730,4274,1718,4275,1704,4276,1702,L,4276,1664,Q,4275,1642,4276,1632,4276,1629,4272,1619,4266,1607,4266,1604,L,4258,1579,Q,4256,1575,4256,1568,4256,1561,4256,1557,4249,1545,4238,1519,4226,1494,4223,1487,4220,1484,4221,1469,4221,1451,4220,1441,4219,1431,4219,1419,4219,1407,4219,1401,4218,1395,4224,1383,4226,1374,4226,1342,4225,1314,4229,1305,4232,1296,4233,1288,4234,1280,4234,1240,4211,1252,4198,1260,L,4175,1271,Q,4159,1275,4143,1281,4142,1281,4129,1282,4122,1283,4116,1286,4107,1291,4106,1291,4099,1293,4088,1293,4076,1293,4059,1298,4044,1302,4034,1301,4027,1300,4009,1302,3992,1303,3983,1304,3981,1304,3980,1304,3897,1319,3864,1315,3852,1313,3835,1318,3816,1324,3807,1326,L,3759,1350,Q,3660,1386,3640,1390,L,3577,1407,Q,3554,1414,3545,1417,3535,1419,3528,1419,3525,1421,3514,1423,3502,1426,3496,1429,3492,1431,3479,1433,3464,1435,3463,1436,Q,3436,1444,3428,1446,Z]],label:"Savojbolagh County",shortLabel:"SA",labelPosition:[289.4,208],labelAlignment:[CEN,MID],nextId:"IR.AL.NA"},"IR.AL.NA":{outlines:[[M,2200,1812,Q,2184,1798,2172,1793,2165,1790,2159,1785,2157,1783,2148,1783,2133,1783,2129,1788,2124,1792,2123,1794,2120,1797,2116,1798,2107,1800,2098,1809,2093,1814,2085,1827,2083,1830,2082,1841,2081,1850,2071,1856,2068,1857,2064,1864,2061,1871,2059,1872,2040,1883,2039,1883,2036,1883,2030,1878,2025,1873,2024,1873,2021,1870,2018,1870,2013,1869,2011,1869,L,1977,1856,Q,1968,1849,1962,1849,1957,1849,1953,1847,1949,1844,1946,1842,1939,1837,1929,1835,1917,1832,1913,1831,1907,1828,1897,1826,1890,1824,1884,1820,1863,1805,1857,1797,1854,1793,1848,1782,1843,1773,1838,1768,1835,1763,1827,1752,1824,1748,1820,1739,1814,1737,1807,1727,1797,1712,1796,1711,L,1783,1698,Q,1782,1690,1779,1687,1776,1684,1773,1681,1772,1681,1772,1681,1762,1685,1758,1687,1735,1691,1725,1694,1671,1711,1656,1715,1640,1720,1618,1730,1596,1739,1587,1744,1549,1766,1529,1782,1480,1820,1476,1825,1435,1874,1372,1929,L,1371,1930,1371,1931,Q,1345,1960,1313,1998,1305,2007,1296,2015,1290,2022,1283,2031,L,1252,2071,Q,1246,2078,1223,2110,1200,2142,1192,2151,1181,2165,1164,2189,1148,2207,1140,2218,1139,2219,1138,2221,1101,2270,1089,2289,1079,2303,1064,2329,1056,2341,1031,2370,982,2433,971,2450,946,2485,943,2488,941,2490,925,2504,916,2511,915,2517,908,2523,898,2532,901,2534,913,2545,924,2555,930,2558,947,2567,981,2580,987,2582,998,2589,1009,2594,1019,2597,1029,2600,1047,2605,1059,2607,1071,2611,1093,2619,1113,2629,1126,2636,1159,2654,1173,2662,1212,2688,1220,2692,1232,2698,1243,2704,1251,2704,1262,2709,1282,2721,1304,2731,1332,2737,1343,2739,1362,2745,1381,2747,1392,2750,1396,2750,1408,2754,1419,2758,1426,2759,1427,2759,1432,2761,1438,2764,1441,2765,L,1461,2768,Q,1466,2769,1485,2770,1498,2770,1503,2772,1517,2776,1539,2774,1547,2773,1559,2779,1566,2783,1577,2789,1598,2798,1611,2810,1627,2824,1661,2863,1680,2886,1688,2892,1701,2903,1721,2911,L,1751,2923,Q,1756,2926,1767,2932,1776,2937,1780,2938,L,1791,2938,Q,1801,2946,1815,2948,1825,2950,1846,2949,1848,2949,1867,2948,1885,2948,1894,2949,1903,2950,1996,2947,2007,2945,2029,2938,2036,2937,2048,2935,2058,2932,2067,2928,2070,2926,2087,2923,2102,2920,2106,2918,2108,2916,2140,2901,L,2207,2862,Q,2210,2860,2224,2856,2236,2852,2238,2852,2247,2851,2267,2842,2278,2842,2299,2841,2314,2841,2325,2845,2325,2839,2330,2830,2336,2820,2338,2814,L,2344,2799,Q,2344,2798,2352,2784,2353,2782,2354,2769,2356,2758,2360,2753,2367,2739,2367,2725,2367,2711,2368,2692,2368,2673,2367,2550,L,2367,2550,Q,2370,2539,2379,2531,2388,2524,2389,2514,2389,2504,2389,2501,2389,2494,2391,2493,2391,2492,2396,2487,2399,2483,2399,2479,2399,2472,2405,2462,2407,2459,2413,2455,2419,2451,2420,2448,2422,2441,2427,2436,2430,2434,2435,2430,2438,2426,2441,2414,2442,2411,2447,2406,2458,2394,2458,2393,2462,2389,2467,2386,2474,2383,2476,2383,2479,2380,2485,2373,2489,2368,2493,2366,2500,2362,2503,2361,2506,2358,2506,2354,2505,2347,2509,2338,2514,2327,2514,2320,2514,2313,2516,2309,2517,2306,2521,2303,2526,2299,2528,2286,L,2527,2270,2533,2256,2534,2240,Q,2534,2224,2527,2214,2524,2209,2508,2191,2503,2186,2501,2183,2498,2179,2494,2178,2484,2178,2477,2174,2457,2163,2447,2163,2442,2162,2419,2163,2398,2163,2385,2161,2377,2157,2372,2155,2369,2154,2369,2153,2367,2152,2367,2141,2366,2130,2367,2118,2368,2104,2371,2097,2374,2089,2379,2080,2384,2070,2392,2056,2399,2043,2399,2024,2399,2004,2393,2e3,2389,1997,2371,1997,2367,1997,2366,1999,2365,2003,2363,2005,2353,2010,2351,2013,2344,2020,2339,2022,2336,2023,2328,2023,2326,2023,2324,2023,2320,2023,2317,2022,2313,2016,2295,2001,2278,1987,2278,1982,2277,1971,2277,1964,2276,1952,2281,1949,2288,1945,2293,1943,2296,1942,2304,1939,L,2305,1938,Q,2305,1934,2301,1934,2294,1934,2293,1933,2292,1923,2286,1924,2277,1925,2273,1922,2273,1921,2267,1909,2262,1904,2260,1899,2258,1890,2256,1886,2237,1864,2235,1859,2234,1857,2225,1849,2218,1844,2218,1836,Q,2218,1825,2200,1812,Z]],label:"Nazarabad County",shortLabel:"NA",labelPosition:[176,235.8],labelAlignment:[CEN,MID],nextId:"IR.AL.ES"},"IR.AL.ES":{outlines:[[M,1113,2629,Q,1093,2619,1071,2611,1059,2607,1047,2605,1029,2600,1019,2597,1009,2594,998,2589,987,2582,981,2580,947,2567,930,2558,924,2555,913,2545,901,2534,898,2532,891,2539,882,2548,861,2568,850,2578,838,2587,833,2594,828,2600,810,2614,791,2628,767,2648,743,2667,731,2675,718,2683,711,2691,705,2698,700,2701,682,2716,637,2751,590,2786,575,2800,560,2813,539,2830,516,2847,495,2868,474,2889,460,2900,444,2920,415,2956,L,407,2966,Q,404,2969,404,2980,396,2996,396,3008,L,395,3038,Q,395,3049,393,3055,L,385,3070,Q,382,3084,382,3103,382,3114,383,3136,L,384,3151,Q,384,3159,377,3175,371,3190,372,3207,L,371,3223,Q,371,3227,369,3230,366,3233,365,3237,363,3246,363,3266,361,3271,357,3280,354,3289,352,3295,L,352,3310,Q,352,3315,351,3317,349,3322,349,3323,343,3339,343,3351,L,332,3378,Q,331,3386,330,3407,325,3419,320,3440,319,3441,315,3449,311,3456,311,3458,310,3465,306,3475,302,3483,300,3491,298,3499,294,3505,284,3520,281,3531,280,3532,270,3561,264,3574,253,3590,244,3603,238,3617,237,3618,236,3620,220,3649,202,3665,190,3676,163,3705,159,3709,139,3721,120,3733,114,3735,102,3739,93,3754,L,72,3778,Q,55,3800,49,3819,48,3824,48,3832,48,3836,49,3846,48,3851,48,3861,48,3865,46,3869,44,3871,44,3875,44,3880,46,3890,47,3901,47,3908,47,3920,48,3926,49,3932,55,3942,57,3947,62,3957,66,3966,72,3972,75,3976,85,3988,92,3996,97,4e3,L,97,4e3,Q,103,4005,118,4011,137,4019,143,4022,168,4035,185,4047,190,4050,207,4061,223,4072,241,4082,258,4092,275,4105,292,4117,314,4132,336,4147,350,4158,364,4168,374,4176,384,4185,391,4191,398,4197,403,4202,408,4206,414,4211,419,4214,421,4217,L,422,4218,Q,440,4228,464,4247,473,4254,507,4283,512,4288,530,4303,547,4318,563,4319,578,4319,603,4318,628,4318,633,4318,637,4319,654,4319,671,4318,676,4317,680,4315,696,4310,711,4305,724,4306,736,4306,769,4306,801,4306,808,4306,L,840,4306,Q,839,4300,837,4297,835,4294,831,4291,827,4286,827,4282,826,4277,825,4276,824,4275,823,4266,821,4258,824,4243,827,4232,828,4202,830,4171,834,4162,838,4154,838,4141,838,4126,840,4121,846,4099,848,4092,851,4086,856,4068,861,4052,861,4041,861,4031,867,4012,875,3993,876,3987,879,3979,890,3959,897,3936,898,3933,905,3903,912,3894,932,3848,933,3848,947,3820,965,3799,969,3795,980,3775,991,3756,998,3749,1003,3743,1015,3733,1025,3724,1029,3718,L,1029,3718,Q,1047,3707,1059,3694,1067,3685,1093,3665,1103,3656,1133,3646,L,1157,3637,Q,1161,3634,1171,3634,1182,3633,1184,3632,1194,3628,1201,3627,1216,3622,1224,3622,1230,3622,1244,3618,1258,3613,1264,3613,1272,3612,1286,3612,1300,3612,1311,3610,L,1330,3605,Q,1340,3602,1359,3602,L,1382,3602,Q,1402,3602,1417,3597,1422,3594,1456,3592,1459,3591,1465,3591,1473,3591,1481,3589,1482,3589,1499,3582,1522,3579,1534,3579,1546,3580,1552,3579,1554,3578,1569,3574,1582,3571,1588,3571,L,1622,3570,Q,1630,3569,1653,3563,1669,3558,1681,3560,L,1726,3559,Q,1727,3559,1758,3550,1763,3550,1772,3548,1782,3548,1794,3548,1806,3549,1826,3544,1847,3540,1853,3540,1854,3540,1885,3539,1906,3538,1917,3535,1931,3531,1944,3530,1953,3528,1979,3529,2015,3530,2048,3522,2075,3515,2104,3515,2118,3516,2141,3516,2143,3516,2146,3516,2163,3512,2213,3509,2248,3505,2250,3505,L,2312,3504,Q,2337,3504,2343,3504,2348,3503,2353,3504,2357,3504,2359,3504,2361,3504,2366,3503,L,2631,3503,Q,2628,3468,2628,3449,2628,3437,2630,3435,2644,3417,2645,3416,2649,3409,2658,3400,2668,3390,2672,3386,2691,3364,2694,3356,2696,3349,2696,3327,2696,3315,2695,3312,2693,3306,2684,3296,2678,3291,2673,3280,2667,3269,2665,3267,2655,3262,2647,3252,2638,3239,2635,3234,2624,3220,2623,3215,2622,3212,2622,3195,2622,3173,2624,3169,2627,3165,2656,3146,2663,3142,2669,3140,2673,3139,2683,3135,2716,3123,2717,3123,L,2753,3108,Q,2765,3103,2768,3102,2772,3097,2783,3091,2793,3086,2798,3084,2801,3081,2803,3079,2807,3075,2811,3075,L,2812,3075,Q,2812,3051,2812,3039,2812,3018,2807,3008,2804,3005,2803,2993,2801,2981,2796,2977,L,2773,2952,Q,2752,2931,2746,2927,2732,2914,2721,2912,2715,2911,2705,2906,2696,2901,2686,2902,2678,2903,2666,2899,2654,2894,2652,2893,L,2530,2893,Q,2525,2892,2517,2892,2505,2892,2496,2898,2488,2905,2470,2905,2452,2905,2446,2902,2444,2901,2420,2886,2403,2879,2394,2873,2379,2866,2370,2861,2364,2859,2360,2856,2359,2855,2355,2852,2353,2851,2351,2851,2344,2851,2341,2851,2336,2850,2330,2847,2327,2846,2325,2845,2314,2841,2299,2841,2278,2842,2267,2842,2247,2851,2238,2852,2236,2852,2224,2856,2210,2860,2207,2862,L,2140,2901,Q,2108,2916,2106,2918,2102,2920,2087,2923,2070,2926,2067,2928,2058,2932,2048,2935,2036,2937,2029,2938,2007,2945,1996,2947,1903,2950,1894,2949,1885,2948,1867,2948,1848,2949,1846,2949,1825,2950,1815,2948,1801,2946,1791,2938,L,1780,2938,Q,1776,2937,1767,2932,1756,2926,1751,2923,L,1721,2911,Q,1701,2903,1688,2892,1680,2886,1661,2863,1627,2824,1611,2810,1598,2798,1577,2789,1566,2783,1559,2779,1547,2773,1539,2774,1517,2776,1503,2772,1498,2770,1485,2770,1466,2769,1461,2768,L,1441,2765,Q,1438,2764,1432,2761,1427,2759,1426,2759,1419,2758,1408,2754,1396,2750,1392,2750,1381,2747,1362,2745,1343,2739,1332,2737,1304,2731,1282,2721,1262,2709,1251,2704,1243,2704,1232,2698,1220,2692,1212,2688,1173,2662,1159,2654,Q,1126,2636,1113,2629,Z]],label:"Eshtehard County",shortLabel:"ES",labelPosition:[94.4,316.1],labelAlignment:[CEN,MID],nextId:"IR.AL.FA"},"IR.AL.FA":{outlines:[[M,3589,2902,Q,3580,2902,3576,2902,3569,2902,3561,2905,3560,2905,3549,2905,3540,2905,3535,2908,3529,2911,3515,2924,3501,2937,3496,2945,L,3460,2995,Q,3450,3011,3446,3018,3440,3026,3437,3030,3434,3035,3433,3039,3433,3041,3433,3043,3412,3076,3384,3105,3360,3124,3350,3134,L,3319,3161,Q,3301,3176,3290,3188,3284,3194,3259,3214,3255,3217,3246,3227,3235,3238,3232,3240,3225,3246,3217,3257,3208,3269,3205,3272,3199,3277,3192,3288,3183,3301,3179,3312,3177,3316,3171,3320,3167,3325,3166,3331,L,3166,3346,Q,3166,3352,3161,3366,3161,3369,3170,3394,3171,3397,3175,3409,3180,3422,3179,3427,3177,3438,3182,3443,3184,3446,3195,3454,3199,3460,3199,3471,3199,3478,3205,3483,3249,3482,3261,3478,3276,3473,3302,3473,3329,3472,3359,3472,3388,3472,3391,3472,3394,3472,3401,3473,3408,3474,3411,3475,3421,3476,3440,3472,3453,3470,3483,3464,L,3646,3464,Q,3689,3454,3700,3454,3715,3453,3721,3452,3729,3451,3736,3447,3738,3446,3739,3445,3743,3444,3750,3443,3761,3441,3771,3437,3777,3434,3789,3433,3801,3431,3810,3427,3815,3424,3845,3414,3870,3406,3884,3396,3887,3394,3901,3388,3917,3383,3921,3380,3924,3378,3929,3374,3933,3370,3936,3368,L,3954,3356,Q,3960,3352,3971,3345,3980,3339,3984,3334,3986,3331,3993,3325,3994,3324,3995,3322,3968,3313,3938,3291,3925,3282,3889,3250,3886,3247,3881,3237,3875,3225,3875,3220,3874,3213,3870,3204,3866,3196,3866,3192,3866,3168,3864,3153,3862,3138,3863,3121,3863,3103,3864,3097,3865,3091,3864,3071,L,3864,3044,Q,3864,3035,3862,3030,3860,3027,3858,3021,3856,3016,3854,3014,3853,3013,3844,3002,3835,2988,3832,2988,3826,2987,3804,2987,3790,2987,3786,2987,L,3784,2987,Q,3774,2987,3759,2994,3743,3e3,3719,3e3,3707,3e3,3701,2998,3692,2994,3682,2983,3667,2964,3652,2951,L,3621,2925,Q,3600,2902,3589,2902,Z]],label:"Fardis County",shortLabel:"FA",labelPosition:[357,321.4],labelAlignment:[CEN,MID]}}}];exports["default"]={extension:geodefinitions,name:"البرز",type:"maps"}}})});