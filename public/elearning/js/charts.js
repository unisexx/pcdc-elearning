 (function($) {
     "use strict";

     /*chart-employment*/
     var chart = c3.generate({
         bindto: '#chart-employment', // id of chart wrapper
         data: {
             columns: [
                 // each columns data
                 ['data1', 9, 4, 9, 11, 15, 17],
                 ['data2', 7, 17, 13, 17, 25, 28],
                 ['data3', 18, 19, 22, 21, 32, 28]
             ],
             type: 'line', // default type of chart
             colors: {
                 data1: '#6c5ffc',
                 data2: '#05c3fb',
                 data3: '#09ad95'
             },
             names: {
                 // name of each serie
                 'data1': 'May',
                 'data2': 'June',
                 'data3': 'July'
             }
         },
         axis: {
             x: {
                 type: 'category',
                 // name of each category
                 categories: ['2013', '2014', '2015', '2016', '2017', '2018']
             },
         },
         legend: {
             show: false, //hide legend
         },
         padding: {
             bottom: 0,
             top: 0
         },
     });

     /*chart-temperature*/
     var chart = c3.generate({
         bindto: '#chart-temperature', // id of chart wrapper
         data: {
             columns: [
                 // each columns data
                 ['data1', 8.0, 7.9, 10.5, 15.5, 19.4, 22.5, 26.2, 27.5, 24.3, 19.3, 14.9, 10.6],
                 ['data2', 4.9, 5.2, 6.7, 9.5, 12.9, 16.2, 18.0, 17.6, 15.2, 11.3, 7.6, 5.8]
             ],
             labels: true,
             type: 'line', // default type of chart
             colors: {
                 data1: '#6c5ffc',
                 data2: '#05c3fb'
             },
             names: {
                 // name of each serie
                 'data1': 'India',
                 'data2': 'USA'
             }
         },
         axis: {
             x: {
                 type: 'category',
                 // name of each category
                 categories: ['May', 'June', 'July', 'Aug', 'Sep', 'Oct']
             },
         },
         legend: {
             show: false, //hide legend
         },
         padding: {
             bottom: 0,
             top: 0
         },
     });

     /*chart-area*/
     var chart = c3.generate({
         bindto: '#chart-area', // id of chart wrapper
         data: {
             columns: [
                 // each columns data
                 ['data1', 12, 8, 16, 19, 20, 18],
                 ['data2', 12, 5, 6, 8, 10, 13]
             ],
             type: 'area', // default type of chart
             colors: {
                 data1: '#6c5ffc',
                 data2: '#05c3fb'
             },
             names: {
                 // name of each serie
                 'data1': 'Maximum',
                 'data2': 'Minimum'
             }
         },
         axis: {
             x: {
                 type: 'category',
                 // name of each category
                 categories: ['May', 'June', 'July', 'Aug', 'Sep', 'Oct']
             },
         },
         legend: {
             show: false, //hide legend
         },
         padding: {
             bottom: 0,
             top: 0
         },
     });

     /*chart-area-spline*/
     var chart = c3.generate({
         bindto: '#chart-area-spline', // id of chart wrapper
         data: {
             columns: [
                 // each columns data
                 ['data1', 10, 8, 10, 12, 20, 18],
                 ['data2', 8, 12, 8, 20, 10, 13]
             ],
             type: 'area-spline', // default type of chart
             colors: {
                 data1: '#6c5ffc',
                 data2: '#05c3fb'
             },
             names: {
                 // name of each serie
                 'data1': 'data1',
                 'data2': 'data2'
             }
         },
         axis: {
             x: {
                 type: 'category',
                 // name of each category
                 categories: ['May', 'June', 'July', 'Aug', 'Sep', 'Oct']
             },
         },
         legend: {
             show: false, //hide legend
         },
         padding: {
             bottom: 0,
             top: 0
         },
     });

     /*chart-area-spline-sracked*/
     var chart = c3.generate({
         bindto: '#chart-area-spline-sracked', // id of chart wrapper
         data: {
             columns: [
                 // each columns data
                 ['data1', 12, 9, 16, 19, 20, 18],
                 ['data2', 8, 8, 6, 8, 10, 13]
             ],
             type: 'area-spline', // default type of chart
             groups: [
                 ['data1', 'data2']
             ],
             colors: {
                 data1: '#6c5ffc',
                 data2: '#05c3fb'
             },
             names: {
                 // name of each serie
                 'data1': 'Maximum',
                 'data2': 'Minimum'
             }
         },
         axis: {
             x: {
                 type: 'category',
                 // name of each category
                 categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
             },
         },
         legend: {
             show: false, //hide legend
         },
         padding: {
             bottom: 0,
             top: 0
         },
     });

     /*chart-area-spline-sracked*/
     var chart = c3.generate({
         bindto: '#chart-sracked', // id of chart wrapper
         data: {
             columns: [
                 // each columns data
                 ['data1', 0, 9, 16, 19, 30, 25, 19, 12, 0],
             ],
             type: 'area-spline', // default type of chart
             groups: [
                 ['data1', 'data2']
             ],
             colors: {
                 data1: '#6c5ffc'
             },
             names: {
                 // name of each serie
                 'data1': 'Maximum'
             }
         },
         axis: {
             x: {
                 type: 'category',
                 // name of each category
                 categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep']
             },
         },
         legend: {
             show: false, //hide legend
         },
         padding: {
             bottom: 0,
             top: 0
         },
     });

     /*chart-spline*/
     var chart = c3.generate({
         bindto: '#chart-spline', // id of chart wrapper
         data: {
             columns: [
                 // each columns data
                 ['data1', 0, 0, 0.2, 0.5, 0.6, 1.2, 2.5, 2.9, 4.5, 4.9, 5.2, 5.8, 6.5, 6.7, 7.4, 4.9, 6.4, 5.4, 10.8, 6.8, 5.2, 11.9],
                 ['data2', 0, 0, 0, 0, 0.3, 0.2, 0.5, 0.6, 1.5, 1.8, 1.9, 2.5, 1.6, 3.8, 3.9, 3.6, 1.8, 1.8, 1.9, 2.8, 5.4, 7.8, 10.9]
             ],
             labels: true,
             type: 'spline', // default type of chart
             colors: {
                 data1: '#6c5ffc',
                 data2: '#05c3fb'
             },
             names: {
                 // name of each serie
                 'data1': 'USA',
                 'data2': 'India'
             }
         },
         axis: {
             x: {
                 type: 'category',
                 // name of each category
                 categories: ['May', 'June', 'July', 'Aug', 'Sep', 'Oct']
             },
         },
         legend: {
             show: false, //hide legend
         },
         padding: {
             bottom: 0,
             top: 0
         },
     });

     /*chart-spline-rotated*/
     var chart = c3.generate({
         bindto: '#chart-spline-rotated', // id of chart wrapper
         data: {
             columns: [
                 // each columns data
                 ['data1', 12, 7, 8, 6, 8, 9, 12],
                 ['data2', 8, 10, 10, 9, 7, 10, 8]
             ],
             type: 'spline', // default type of chart
             colors: {
                 data1: '#6c5ffc',
                 data2: '#05c3fb'
             },
             names: {
                 // name of each serie
                 'data1': 'Maximum',
                 'data2': 'Minimum'
             }
         },
         axis: {
             x: {
                 type: 'category',
                 // name of each category
                 categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
             },
             rotated: true,
         },
         legend: {
             show: false, //hide legend
         },
         padding: {
             bottom: 0,
             top: 0
         },
     });

     /*chart-step*/
     var chart = c3.generate({
         bindto: '#chart-step', // id of chart wrapper
         data: {
             columns: [
                 // each columns data
                 ['data1', 10, 15, 10, 18, 19, 15],
                 ['data2', 7, 7, 5, 7, 9, 12]
             ],
             type: 'step', // default type of chart
             colors: {
                 data1: '#6c5ffc',
                 data2: '#05c3fb'
             },
             names: {
                 // name of each serie
                 'data1': 'Maximum',
                 'data2': 'Minimum'
             }
         },
         axis: {
             x: {
                 type: 'category',
                 // name of each category
                 categories: ['May', 'June', 'July', 'Aug', 'Sep', 'Oct']
             },
         },
         legend: {
             show: false, //hide legend
         },
         padding: {
             bottom: 0,
             top: 0
         },
     });

     /*chart-area-step*/
     var chart = c3.generate({
         bindto: '#chart-area-step', // id of chart wrapper
         data: {
             columns: [
                 // each columns data
                 ['data1', 15, 14, 18, 19, 20, 18],
                 ['data2', 10, 10, 12, 14, 15, 13]
             ],
             type: 'area-step', // default type of chart
             colors: {
                 data1: '#6c5ffc',
                 data2: '#05c3fb'
             },
             names: {
                 // name of each serie
                 'data1': 'Maximum',
                 'data2': 'Minimum'
             }
         },
         axis: {
             x: {
                 type: 'category',
                 // name of each category
                 categories: ['May', 'June', 'July', 'Aug', 'Sep', 'Oct']
             },
         },
         legend: {
             show: false, //hide legend
         },
         padding: {
             bottom: 0,
             top: 0
         },
     });
     
     /*chart-bar*/
     var chart = c3.generate({
         bindto: '#chart-bar', // id of chart wrapper
         data: {
             columns: [
                 // each columns data
                 ['data1', 11, 8, 15, 18, 19, 17],
                 ['data2', 7, 7, 5, 7, 9, 12]
             ],
             type: 'bar', // default type of chart
             colors: {
                 data1: '#6c5ffc',
                 data2: '#05c3fb'
             },
             names: {
                 // name of each serie
                 'data1': 'Maximum',
                 'data2': 'Minimum'
             }
         },
         axis: {
             x: {
                 type: 'category',
                 // name of each category
                 categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
             },
         },
         bar: {
             width: 16
         },
         legend: {
             show: false, //hide legend
         },
         padding: {
             bottom: 0,
             top: 0
         },
     });

     /*chart-bar รายงานสถิติ จำนวนผู้ผ่านหลักสูตรต่างๆ ปี 2567*/
     var chart = c3.generate({
        bindto: '#chart-bar2', // id of chart wrapper
        data: {
            columns: [
                // each columns data
                ['data1', 11, 8, 15, 18, 19, 17],
                ['data2', 50, 50, 15, 41, 59, 42],
                ['data3', 70, 40, 25, 22, 41, 22],
                ['data4', 20, 30, 35, 100, 20, 75],
                ['data5', 40, 20, 55, 20, 99, 30],
                ['data6', 21, 31, 65, 30, 40, 50],
                ['data7', 8, 12, 60, 44, 39, 12],
                ['data8', 70, 10, 5, 17, 29, 122]
            ],
            type: 'bar', // default type of chart
            colors: {
                data1: '#f86e90',
                data2: '#05c3fb',
                data3: '#4cb140',
                data4: '#009596',
                data5: '#5752d1',
                data6: '#ec7a08',
                data7: '#ecc35c',
                data8: '#2a64c5'
            },
            names: {
                // name of each serie
                'data1': 'หลักสูตรที่ 1 โรคติดต่อในเด็กและโควิด 19',
                'data2': 'หลักสูตรที่ 2 โรคติดเชื้อทางเดินหายใจจากเชื้อไวรัสอาร์เอสวี',
                'data3': 'หลักสูตรที่ 3 โรคไข้หวัดใหญ่ในเด็ก',
                'data4': 'หลักสูตรที่ 4 โรคมือเท้าปาก',
                'data5': 'หลักสูตรที่ 5 โรคเฮอร์แปงไจน่า',
                'data6': 'หลักสูตรที่ 6 โรคติดเชื้อไอพีดี',
                'data7': 'หลักสูตรที่ 7 โรคท้องเสียจากการติดเชื้อโนโรไวรัส',
                'data8': 'หลักสูตรที่ 8 โรคอีสุกอีใส'
            }
        },
        axis: {
            x: {
                type: 'category',
                // name of each category
                categories: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน']
            },
        },
        bar: {
            /*width: 10*/
            width: {
                ratio: 0.5
            }
        },
        legend: {
            show: true, //hide legend
        },
        padding: {
            bottom: 0,
            top: 0
        },
    });   

     /*chart-bar รายงานสถิติ ผู้ผ่านแบบทดสอบหลักสูตรที่ 1 โรคติดต่อในเด็กและโควิด 19 จำแนกรายเขตและจังหวัด ปี 2567*/
     var chart = c3.generate({
         bindto: '#chart-monthly', // id of chart wrapper
         data: {
             columns: [
                 // each columns data
                 ['data1', 11, 8, 35, 18, 19, 17, 33, 39, 48, 57, 39, 63]
             ],
             type: 'bar', // default type of chart
             colors: {
                 data1: '#6c5ffc'
             },
             names: {
                 // name of each serie
                 'data1': 'ผ่าน'
             }
         },
         axis: {
             x: {
                 type: 'category',
                 // name of each category
                 categories: ['สคร.1', 'สคร.2', 'สคร.3', 'สคร.4', 'สคร.5', 'สคร.6', 'สคร.7', 'สคร.8', 'สคร.9', 'สคร.10', 'สคร.11', 'สคร.12', 'กทม.']
             },
         },
         bar: {
             /*width: 30*/
             width: {
                ratio: 0.7
            }
         },
         legend: {
             show: false, //hide legend
         },
         padding: {
             bottom: 0,
             top: 0
         },
     });

/*chart-bar รายงานสถิติ ผู้ผ่านแบบทดสอบหลักสูตรที่ 1 โรคติดต่อในเด็กและโควิด 19 จำแนกรายเขตและจังหวัด ปี 2567*/
     var chart = c3.generate({
        bindto: '#chart-monthly2',
        data: {
            x : 'x',
            columns: [
                ['x','เชียงใหม่', 'เชียงราย', 'แพร่', 'แม่ฮ่องสอน', 'น่าน', 'พะเยา', 'ลำปาง', 'ลำพูน', 'เพชรบูรณ์', 'ตาก', 
                'พิษณุโลก', 'สุโขทัย', 'อุตรดิตถ์', 'กำแพงเพชร','ชัยนาท','นครสวรรค์','พิจิตร','อุทัยธานี','นครนายก','นนทบุรี',
                'ปทุมธานี','พระนครศรีอยุธยา','ลพบุรี','สระบุรี','สิงห์บุรี','อ่างทอง','เพชรบุรี','กาญจนบุรี','นครปฐม','ประจวบคีรีขันธ์',
                'ราชบุรี','สมุทรสงคราม','สมุทรสาคร','สุพรรณบุรี','จันทบุรี','ฉะเชิงเทรา','ชลบุรี','ตราด','ปราจีนบุรี','ระยอง',
                'สมุทรปราการ','สระแก้ว','กาฬสินธุ์','ขอนแก่น','มหาสารคาม','ร้อยเอ็ด','เลย','นครพนม','บึงกาฬ','สกลนคร',
                'หนองคาย','หนองบัวลำภู','อุดรธานี','ชัยภูมิ','นครราชสีมา','บุรีรัมย์','สุรินทร์','มุกดาหาร','ยโสธร','ศรีสะเกษ',
                'อำนาจเจริญ','อุบลราชธานี','กระบี่','ชุมพร','นครศรีธรรมราช','พังงา','ภูเก็ต','ระนอง','สุราษฎร์ธานี','ตรัง',
                'นราธิวาส','ปัตตานี','พัทลุง','ยะลา','สงขลา','สตูล','กรุงเทพมหานคร'],
                ['ผ่าน', 10, 20, 34, 40, 50, 60, 70, 80, 94, 100, 10, 20, 34, 40, 50, 60, 70, 80, 94, 100, 10, 20, 34, 40, 50, 60, 70, 80, 94, 100, 
                10, 20, 34, 40, 50, 60, 70, 80, 94, 100,10, 20, 34, 40, 50, 60, 70, 80, 94, 100,10, 20, 34, 40, 50, 60, 70, 80, 94, 100,10, 20, 34, 40, 50, 60, 70, 80, 94, 100,
                10, 20, 34, 40, 50, 60, 70],
            ],
            type: 'bar',
        },
        axis: {
            x: {
                type: 'category',
                tick: {
                    rotate: 75,
                    multiline: false,
                },
                height: 130
            }
        },
        bar: {
            /*width: 6*/
            width: {
                ratio: 0.2
            }
        },
        legend: {
            show: false, //hide legend
        },
    });

     /*chart-bar-rotated*/
     var chart = c3.generate({
         bindto: '#chart-bar-rotated', // id of chart wrapper
         data: {
             columns: [
                 // each columns data
                 ['data1', 11, 8, 15, 18, 19, 17],
                 ['data2', 7, 7, 5, 7, 9, 12]
             ],
             type: 'bar', // default type of chart
             colors: {
                 data1: '#6c5ffc',
                 data2: '#05c3fb'
             },
             names: {
                 // name of each serie
                 'data1': 'Maximum',
                 'data2': 'Minimum'
             }
         },
         axis: {
             x: {
                 type: 'category',
                 // name of each category
                 categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
             },
             rotated: true,
         },
         bar: {
             width: 15
         },
         legend: {
             show: false, //hide legend
         },
         padding: {
             bottom: 0,
             top: 0
         },
     });

     /*chart-bar-stacked รายงานสถิติ ผู้ทำแบบทดสอบหลักสูตรที่ 1 โรคติดต่อในเด็กและโควิด 19<br>เปรียบเทียบ ผู้ที่ผ่าน และ ไม่ผ่าน ปี 2567 */
     var chart = c3.generate({
         bindto: '#chart-bar-stacked', // id of chart wrapper
         data: {
             columns: [
                 // each columns data
                 ['data1', 11, 8, 15, 18, 19, 17, 20, 25, 32, 20, 14, 20],
                 ['data2', 7, 7, 5, 7, 9, 12, 4, 6, 2, 5, 2, 8]
             ],
             type: 'bar', // default type of chart
             groups: [
                 ['data1', 'data2']
             ],
             colors: {
                 data1: '#6c5ffc',
                 data2: '#05c3fb'
             },
             names: {
                 // name of each serie
                 'data1': 'ผ่าน',
                 'data2': 'ไม่ผ่าน'
             }
         },
         axis: {   
             x: {
                 type: 'category',
                 // name of each category
                 categories: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.']
             },
         },
         bar: {
             /*width: 16*/
             width: {
                ratio: 0.5
            }
         },
         legend: {
             show: true, //hide legend
         },
         padding: {
             bottom: 0,
             top: 0
         },
     });

     /*chart-pie*/
     var chart = c3.generate({
         bindto: '#chart-pie', // id of chart wrapper
         data: {
             columns: [
                 // each columns data
                 ['data1', 63],
                 ['data2', 44],
                 ['data3', 12],
                 ['data4', 14]
             ],
             type: 'pie', // default type of chart
             colors: {
                 data1: '#6c5ffc',
                 data2: '#05c3fb',
                 data3: '#09ad95',
                 data4: '#1170e4'
             },
             names: {
                 // name of each serie
                 'data1': 'A',
                 'data2': 'B',
                 'data3': 'C',
                 'data4': 'D'
             }
         },
         axis: {},
         legend: {
             show: false, //hide legend
         },
         padding: {
             bottom: 0,
             top: 0
         },
     });

     /*chart-pie*/
     var chart = c3.generate({
         bindto: '#chart-pie2', // id of chart wrapper
         data: {
             columns: [
                 // each columns data
                 ['data1', 63],
                 ['data2', 40],
                 ['data3', 12],
                 ['data4', 14],
                 ['data5', 20],
                 ['data6', 29],
             ],
             type: 'pie', // default type of chart
             colors: {
                 'data1': '#6c5ffc',
                 'data2': '#05c3fb',
                 'data3': '#09ad95',
                 'data4': '#1170e4',
                 'data5': '#f82649',
                 'data6': '#f7b731',
             },
             names: {
                 // name of each serie
                 'data1': 'A',
                 'data2': 'B',
                 'data3': 'C',
                 'data4': 'D',
                 'data5': 'E',
                 'data6': 'F'
             }
         },
         axis: {},
         legend: {
             show: false, //hide legend
         },
         padding: {
             bottom: 0,
             top: 0
         },
     });

     /*chart-pie*/
     var chart = c3.generate({
         bindto: '#chart-pie3', // id of chart wrapper
         data: {
             columns: [
                 // each columns data
                 ['data1', 63],
                 ['data2', 44],
                 ['data3', 28]
             ],
             type: 'pie', // default type of chart
             colors: {
                 'data1': '#6c5ffc',
                 'data2': '#05c3fb',
                 'data3': '#09ad95'
             },
             names: {
                 // name of each serie
                 'data1': 'A',
                 'data2': 'B',
                 'data3': 'C'
             }
         },
         axis: {},
         legend: {
             show: false, //hide legend
         },
         padding: {
             bottom: 0,
             top: 0
         },
     });

     /*chart-pie*/
     var chart = c3.generate({
         bindto: '#chart-pie4', // id of chart wrapper
         data: {
             columns: [
                 // each columns data
                 ['data1', 58],
                 ['data2', 45],
                 ['data3', 20],
                 ['data4', 14]
             ],
             type: 'pie', // default type of chart
             colors: {
                 'data1': '#6c5ffc',
                 'data2': '#05c3fb',
                 'data3': '#09ad95',
                 'data4': '#1170e4'
             },
             names: {
                 // name of each serie
                 'data1': 'A',
                 'data2': 'B',
                 'data3': 'C',
                 'data4': 'D'
             }
         },
         axis: {},
         legend: {
             show: false, //hide legend
         },
         padding: {
             bottom: 0,
             top: 0
         },
     });

     /*chart-donut*/
     var chart = c3.generate({
         bindto: '#chart-donut', // id of chart wrapper
         data: {
             columns: [
                 // each columns data
                 ['data1', 78],
                 ['data2', 95],
                 ['data3', 25],
             ],
             type: 'donut', // default type of chart
             colors: {
                 data1: '#6c5ffc',
                 data2: '#05c3fb',
                 data3: '#09ad95',
             },
             names: {
                 // name of each serie
                 'data1': 'sales1',
                 'data2': 'sales2',
                 'data3': 'sales3'
             }
         },
         axis: {},
         legend: {
             show: false, //hide legend
         },
         padding: {
             bottom: 0,
             top: 0
         },
     });

     /*chart-donut*/
     var chart = c3.generate({
         bindto: '#chart-donut2', // id of chart wrapper
         data: {
             columns: [
                 // each columns data
                 ['data1', 78],
                 ['data2', 95],
                 ['data3', 25],
                 ['data4', 45],
                 ['data5', 75],
                 ['data6', 25],
             ],
             type: 'donut', // default type of chart
             colors: {
                 'data1': '#6c5ffc',
                 'data2': '#05c3fb',
                 'data3': '#09ad95',
                 'data4': '#1170e4',
                 'data5': '#f82649',
                 'data6': '#f7b731',
             },
             names: {
                 // name of each serie
                 'data1': 'sales1',
                 'data2': 'sales2',
                 'data3': 'sales3',
                 'data4': 'sales4',
                 'data5': 'sales5',
                 'data6': 'sales6',
             }
         },
         axis: {},
         legend: {
             show: false, //hide legend
         },
         padding: {
             bottom: 0,
             top: 0
         },
     });

   /*chart-donut*/
   var chart = c3.generate({
    bindto: '#chart-donut2_2', // id of chart wrapper
    data: {
        columns: [
            // each columns data
            ['data1', 80],
            ['data2', 20],
        ],
        type: 'donut', // default type of chart
        colors: {
            'data1': '#fb8b09',
            'data2': '#eee',
        },
        names: {
            // name of each serie
            'data1': 'ตอบถูก',
            'data2': 'ตอบผิด',
        }
    },
    axis: {},
    legend: {
        show: false, //hide legend
    },
    padding: {
        bottom: 0,
        top: 0
    },
});
   /*chart-donut*/
   var chart = c3.generate({
    bindto: '#chart-donut2_3', // id of chart wrapper
    data: {
        columns: [
            // each columns data
            ['data1', 100],
            ['data2', 0],
        ],
        type: 'donut', // default type of chart
        colors: {
            'data1': '#fb8b09',
            'data2': '#eee',
        },
        names: {
            // name of each serie
            'data1': 'ตอบถูก',
            'data2': 'ตอบผิด',
        }
    },
    axis: {},
    legend: {
        show: false, //hide legend
    },
    padding: {
        bottom: 0,
        top: 0
    },
});
     /*chart-donut*/
     var chart = c3.generate({
         bindto: '#chart-donut3', // id of chart wrapper
         data: {
             columns: [
                 // each columns data
                 ['data1', 78],
                 ['data2', 95]
             ],
             type: 'donut', // default type of chart
             colors: {
                 'data1': '#6c5ffc',
                 'data2': '#05c3fb',
             },
             names: {
                 // name of each serie
                 'data1': 'sales1',
                 'data2': 'sales2'
             }
         },
         axis: {},
         legend: {
             show: false, //hide legend
         },
         padding: {
             bottom: 0,
             top: 0
         },
     });

     /*chart-donut*/
     var chart = c3.generate({
         bindto: '#chart-donut4', // id of chart wrapper
         data: {
             columns: [
                 // each columns data
                 ['data1', 78],
                 ['data2', 95],
                 ['data3', 25],
                 ['data4', 45]
             ],
             type: 'donut', // default type of chart
             colors: {
                 'data1': '#6c5ffc',
                 'data2': '#05c3fb',
                 'data3': '#09ad95',
                 'data4': '#1170e4',
             },
             names: {
                 // name of each serie
                 'data1': 'sales1',
                 'data2': 'sales2',
                 'data3': 'sales3',
                 'data4': 'sales4',
             }
         },
         axis: {},
         legend: {
             show: false, //hide legend
         },
         padding: {
             bottom: 0,
             top: 0
         },
     });

     /*chart-donut*/
     var chart = c3.generate({
         bindto: '#chart-donut5', // id of chart wrapper
         data: {
             columns: [
                 // each columns data
                 ['data1', 78],
                 ['data2', 95],
                 ['data3', 25],
                 ['data4', 45]
             ],
             type: 'donut', // default type of chart
             colors: {
                 'data1': '#6c5ffc',
                 'data2': '#05c3fb',
                 'data3': '#09ad95',
                 'data4': '#1170e4',
             },
             names: {
                 // name of each serie
                 'data1': 'USA',
                 'data2': 'Canada',
                 'data3': 'India',
                 'data4': 'France',
             }
         },
         axis: {},
         legend: {
             show: false, //hide legend
         },
         padding: {
             bottom: 0,
             top: 0
         },
     });

     /*chart-scatter*/
     var chart = c3.generate({
         bindto: '#chart-scatter', // id of chart wrapper
         data: {
             columns: [
                 // each columns data
                 ['data1', 11, 8, 15, 18, 19, 17],
                 ['data2', 7, 7, 5, 7, 9, 12]
             ],
             type: 'scatter', // default type of chart
             colors: {
                 data1: 'green',
                 data2: 'red'
             },
             names: {
                 // name of each serie
                 'data1': 'Maximum',
                 'data2': 'Minimum'
             }
         },
         axis: {
             x: {
                 type: 'category',
                 // name of each category
                 categories: ['May', 'Jun', 'July', 'Aug', 'Sep', 'Oct']
             },
         },
         legend: {
             show: false, //hide legend
         },
         padding: {
             bottom: 0,
             top: 0
         },
     });

     /*chart-combination*/
     var chart = c3.generate({
         bindto: '#chart-combination', // id of chart wrapper
         data: {
             columns: [
                 // each columns data
                 ['data1', 100, 130, 150, 240, 130, 220],
                 ['data2', 250, 200, 220, 400, 250, 350],
                 ['data3', 100, 130, 150, 240, 130, 220]
             ],
             type: 'bar', // default type of chart
             types: {
                 'data1': "line",
                 'data2': "spline",
             },
             groups: [
                 ['data3']
             ],
             colors: {
                 data1: '#6c5ffc',
                 data2: '#05c3fb',
                 data3: '#09ad95'
             },
             color: function(color, d) {
                 // d will be 'id' when called for legends
                 return d.id && d.id === 'data3' ? d3.rgb(98, 89, 202) : color;
                 //return d.id && d.id === 'data3' ? d3.rgb(98, 89, 202) :color;
                 //return d.id && d.id === 'data3' ? d3.rgb(98, 89, 202).darker(d.value / 120) : color;
             },
             names: {
                 // name of each serie
                 'data1': 'Marketing',
                 'data2': 'Development',
                 'data3': 'Sales'
             }
         },
         axis: {
             x: {
                 type: 'category',
                 // name of each category
                 categories: ['2007-20082008', '2009-2010', '2011-2012', '2013-2014', '2015-2016', '2017-2018']
             },
         },
         bar: {
             width: 50
         },
         legend: {
             show: false, //hide legend
         },
         padding: {
             bottom: 0,
             top: 0
         },
     });

     /*chart-wrapper*/
     var chart = c3.generate({
         bindto: '#chart-wrapper', // id of chart wrapper
         data: {
             columns: [
                 // each columns data
                 ['data1', 7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6],
                 ['data2', 3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
             ],
             labels: true,
             type: 'line', // default type of chart
             colors: {
                 data1: 'purple',
                 data2: 'pink'
             },
             names: {
                 // name of each serie
                 'data1': 'Tokyo',
                 'data2': 'London'
             }
         },
         axis: {
             x: {
                 type: 'category',
                 // name of each category
                 categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
             },
         },
         legend: {
             show: false, //hide legend
         },
         padding: {
             bottom: 0,
             top: 0
         },
     });
     
 })(jQuery);