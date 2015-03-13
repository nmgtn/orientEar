// First Chart Example - Area Line Chart

Morris.Area({
    // ID of the element in which to draw the chart.
    element: 'morris-scoregraph-area',
    // Chart data records -- each entry in this array corresponds to a point on
    // the chart.
    data: [
    { d: '2015-03-01', score: 60 },
    { d: '2015-03-02', score: 65 },
    { d: '2015-03-05', score: 62 },
    { d: '2015-03-07', score:  64 },
    { d: '2015-03-08', score: 69 },
    { d: '2015-03-10', score: 72 },
    { d: '2015-03-14', score: 74 },
    ],
    // The name of the data record attribute that contains x-visitss.
    xkey: 'd',
    // A list of names of data record attributes that contain y-visitss.
    ykeys: ['score'],
    // Labels for the ykeys -- will be displayed when you hover over the
    // chart.
    labels: ['Score'],
    // Disables line smoothing
    smooth: true,
});
