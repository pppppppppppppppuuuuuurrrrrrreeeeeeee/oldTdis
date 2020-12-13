//observe

$.get( "../../model/statistics.php?todayObserve", function( data ) {
    let values = JSON.parse(data);
    let datasArr = [];
    values.forEach(element => {
        let obj = {};
        obj.label = element[0];
        obj.value = element[1];
        datasArr.push(obj);
    });
    FusionCharts.ready(function(){
        var chartObj = new FusionCharts({
            type: 'pie3d',
            renderAt: 'todayObserve',
            width: '450',
            height: '300',
            dataFormat: 'json',
            dataSource: {
                "chart": {
                    "caption": "Todays's observations",
                    "subCaption": "",
                    "numberPrefix": "",
                    "showPercentInTooltip": "0",
                    "decimals": "1",
                    "useDataPlotColorForLabels": "1",
                    //Theme
                    "theme": "fusion"
                },
                "data": datasArr
            }
        }
        );
        chartObj.render();
    });

});

$.get( "../../model/statistics.php?yesterdayObserve", function( data ) {
    let values = JSON.parse(data);
    let datasArr = [];
    values.forEach(element => {
        let obj = {};
        obj.label = element[0];
        obj.value = element[1];
        datasArr.push(obj);
    });
    FusionCharts.ready(function(){
        var chartObj = new FusionCharts({
            type: 'pie3d',
            renderAt: 'yesterdayObserve',
            width: '450',
            height: '300',
            dataFormat: 'json',
            dataSource: {
                "chart": {
                    "caption": "Yesterday's observations",
                    "subCaption": "",
                    "numberPrefix": "",
                    "showPercentInTooltip": "0",
                    "decimals": "1",
                    "useDataPlotColorForLabels": "1",
                    //Theme
                    "theme": "fusion"
                },
                "data": datasArr
            }
        }
        );
        chartObj.render();
    });

});

$.get( "../../model/statistics.php?weekObserve", function( data ) {
    let values = JSON.parse(data);
    let datasArr = [];
    values.forEach(element => {
        let obj = {};
        obj.label = element[0];
        obj.value = element[1];
        datasArr.push(obj);
    });
    FusionCharts.ready(function(){
        var chartObj = new FusionCharts({
            type: 'pie3d',
            renderAt: 'weekObserve',
            width: '450',
            height: '300',
            dataFormat: 'json',
            dataSource: {
                "chart": {
                    "caption": "Last week's observations",
                    "subCaption": "",
                    "numberPrefix": "",
                    "showPercentInTooltip": "0",
                    "decimals": "1",
                    "useDataPlotColorForLabels": "1",
                    //Theme
                    "theme": "fusion"
                },
                "data": datasArr
            }
        }
        );
        chartObj.render();
    });

});


//edit

$.get( "../../model/statistics.php?todayEdit", function( data ) {
    let values = JSON.parse(data);
    let datasArr = [];
    values.forEach(element => {
        let obj = {};
        obj.label = element[0];
        obj.value = element[1];
        datasArr.push(obj);
    });
    FusionCharts.ready(function(){
        var chartObj = new FusionCharts({
            type: 'pie3d',
            renderAt: 'todayEdit',
            width: '450',
            height: '300',
            dataFormat: 'json',
            dataSource: {
                "chart": {
                    "caption": "Todays's edits",
                    "subCaption": "",
                    "numberPrefix": "",
                    "showPercentInTooltip": "0",
                    "decimals": "1",
                    "useDataPlotColorForLabels": "1",
                    //Theme
                    "theme": "fusion"
                },
                "data": datasArr
            }
        }
        );
        chartObj.render();
    });

});

$.get( "../../model/statistics.php?yesterdayEdit", function( data ) {
    let values = JSON.parse(data);
    let datasArr = [];
    values.forEach(element => {
        let obj = {};
        obj.label = element[0];
        obj.value = element[1];
        datasArr.push(obj);
    });
    FusionCharts.ready(function(){
        var chartObj = new FusionCharts({
            type: 'pie3d',
            renderAt: 'yesterdayEdit',
            width: '450',
            height: '300',
            dataFormat: 'json',
            dataSource: {
                "chart": {
                    "caption": "Yesterday's edits",
                    "subCaption": "",
                    "numberPrefix": "",
                    "showPercentInTooltip": "0",
                    "decimals": "1",
                    "useDataPlotColorForLabels": "1",
                    //Theme
                    "theme": "fusion"
                },
                "data": datasArr
            }
        }
        );
        chartObj.render();
    });

});

$.get( "../../model/statistics.php?weekEdit", function( data ) {
    let values = JSON.parse(data);
    let datasArr = [];
    values.forEach(element => {
        let obj = {};
        obj.label = element[0];
        obj.value = element[1];
        datasArr.push(obj);
    });
    FusionCharts.ready(function(){
        var chartObj = new FusionCharts({
            type: 'pie3d',
            renderAt: 'weekEdit',
            width: '450',
            height: '300',
            dataFormat: 'json',
            dataSource: {
                "chart": {
                    "caption": "Last week's edits",
                    "subCaption": "",
                    "numberPrefix": "",
                    "showPercentInTooltip": "0",
                    "decimals": "1",
                    "useDataPlotColorForLabels": "1",
                    //Theme
                    "theme": "fusion"
                },
                "data": datasArr
            }
        }
        );
        chartObj.render();
    });

});


//delete

$.get( "../../model/statistics.php?todayDelete", function( data ) {
    let values = JSON.parse(data);
    let datasArr = [];
    values.forEach(element => {
        let obj = {};
        obj.label = element[0];
        obj.value = element[1];
        datasArr.push(obj);
    });
    FusionCharts.ready(function(){
        var chartObj = new FusionCharts({
            type: 'pie3d',
            renderAt: 'todayDelete',
            width: '450',
            height: '300',
            dataFormat: 'json',
            dataSource: {
                "chart": {
                    "caption": "Todays's deletes",
                    "subCaption": "",
                    "numberPrefix": "",
                    "showPercentInTooltip": "0",
                    "decimals": "1",
                    "useDataPlotColorForLabels": "1",
                    //Theme
                    "theme": "fusion"
                },
                "data": datasArr
            }
        }
        );
        chartObj.render();
    });

});

$.get( "../../model/statistics.php?yesterdayDelete", function( data ) {
    let values = JSON.parse(data);
    let datasArr = [];
    values.forEach(element => {
        let obj = {};
        obj.label = element[0];
        obj.value = element[1];
        datasArr.push(obj);
    });
    FusionCharts.ready(function(){
        var chartObj = new FusionCharts({
            type: 'pie3d',
            renderAt: 'yesterdayDelete',
            width: '450',
            height: '300',
            dataFormat: 'json',
            dataSource: {
                "chart": {
                    "caption": "Yesterday's deletes",
                    "subCaption": "",
                    "numberPrefix": "",
                    "showPercentInTooltip": "0",
                    "decimals": "1",
                    "useDataPlotColorForLabels": "1",
                    //Theme
                    "theme": "fusion"
                },
                "data": datasArr
            }
        }
        );
        chartObj.render();
    });

});

$.get( "../../model/statistics.php?weekDelete", function( data ) {
    let values = JSON.parse(data);
    let datasArr = [];
    values.forEach(element => {
        let obj = {};
        obj.label = element[0];
        obj.value = element[1];
        datasArr.push(obj);
    });
    FusionCharts.ready(function(){
        var chartObj = new FusionCharts({
            type: 'pie3d',
            renderAt: 'weekDelete',
            width: '450',
            height: '300',
            dataFormat: 'json',
            dataSource: {
                "chart": {
                    "caption": "Last week's deletes",
                    "subCaption": "",
                    "numberPrefix": "",
                    "showPercentInTooltip": "0",
                    "decimals": "1",
                    "useDataPlotColorForLabels": "1",
                    //Theme
                    "theme": "fusion"
                },
                "data": datasArr
            }
        }
        );
        chartObj.render();
    });

});



//police

$.get( "../../model/statistics.php?todaySendToPolice", function( data ) {
    let values = JSON.parse(data);
    let datasArr = [];
    values.forEach(element => {
        let obj = {};
        obj.label = element[0];
        obj.value = element[1];
        datasArr.push(obj);
    });
    FusionCharts.ready(function(){
        var chartObj = new FusionCharts({
            type: 'pie3d',
            renderAt: 'todayPolice',
            width: '450',
            height: '300',
            dataFormat: 'json',
            dataSource: {
                "chart": {
                    "caption": "Todays's Sents",
                    "subCaption": "",
                    "numberPrefix": "",
                    "showPercentInTooltip": "0",
                    "decimals": "1",
                    "useDataPlotColorForLabels": "1",
                    //Theme
                    "theme": "fusion"
                },
                "data": datasArr
            }
        }
        );
        chartObj.render();
    });

});

$.get( "../../model/statistics.php?yesterdaySendToPolice", function( data ) {
    let values = JSON.parse(data);
    let datasArr = [];
    values.forEach(element => {
        let obj = {};
        obj.label = element[0];
        obj.value = element[1];
        datasArr.push(obj);
    });
    FusionCharts.ready(function(){
        var chartObj = new FusionCharts({
            type: 'pie3d',
            renderAt: 'yesterdayPolice',
            width: '450',
            height: '300',
            dataFormat: 'json',
            dataSource: {
                "chart": {
                    "caption": "Yesterday's Sents",
                    "subCaption": "",
                    "numberPrefix": "",
                    "showPercentInTooltip": "0",
                    "decimals": "1",
                    "useDataPlotColorForLabels": "1",
                    //Theme
                    "theme": "fusion"
                },
                "data": datasArr
            }
        }
        );
        chartObj.render();
    });

});

$.get( "../../model/statistics.php?weekSendToPolice", function( data ) {
    let values = JSON.parse(data);
    let datasArr = [];
    values.forEach(element => {
        let obj = {};
        obj.label = element[0];
        obj.value = element[1];
        datasArr.push(obj);
    });
    FusionCharts.ready(function(){
        var chartObj = new FusionCharts({
            type: 'pie3d',
            renderAt: 'weekPolice',
            width: '450',
            height: '300',
            dataFormat: 'json',
            dataSource: {
                "chart": {
                    "caption": "Last week's Sents",
                    "subCaption": "",
                    "numberPrefix": "",
                    "showPercentInTooltip": "0",
                    "decimals": "1",
                    "useDataPlotColorForLabels": "1",
                    //Theme
                    "theme": "fusion"
                },
                "data": datasArr
            }
        }
        );
        chartObj.render();
    });

});

