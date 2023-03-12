$(document).ready(()=>{
    $('.chart-button button').on('click', function(){
        // chart button
        // $('.chart-button button').removeClass('active');

        // $('.chart-button button').each(()=>{
        //     $(this).addClass('active')
        // })

        // 與上面功能相同
        $('.chart-button button').each(()=>{
            $('.chart-button button.active').removeClass('active');
            $(this).addClass('active')
        })

        let type = $(this).data('type');
        
        let $content = $('.chart-content .chart-container');
        $content.find('.chart.active').removeClass('active');

        $content.each(function(){
            $(this).find(`.chart[data-content = ${type}]`).addClass('active');
        });
    })
})