$(function () {
$('.carousel').carousel({
   interval: 2000
});
let wow = new WOW({
        animateClass: 'animated',
        mobile: true,
        live: true
    });
    wow.init();
})
$(document).ready(function() {
    var imgsObj = $('.amplifyImg img'); //需要放大的图像
    if (imgsObj) {
        $.each(imgsObj, function() {
            $(this).click(function() {
                var currImg = $(this);
                coverLayer(1);
                var tempContainer = $('<div class=tempContainer></div>'); //图片容器
                with(tempContainer) { //width方法等同于$(this)
                    appendTo("body");
                    var windowWidth = $(window).width();
                    var windowHeight = $(window).height();
                    //获取图片原始宽度、高度
                    var orignImg = new Image();
                    orignImg.src = currImg.attr("src");
                    var currImgWidth = orignImg.width;
                    var currImgHeight = orignImg.height;
                    if (currImgWidth < windowWidth) { //为了让图片不失真，当图片宽度较小的时候，保留原图
                        if (currImgHeight < windowHeight) {
                            var topHeight = (windowHeight - currImgHeight) / 2;
                            if (topHeight > 35) { /*此处为了使图片高度上居中显示在整个手机屏幕中：因为在android,ios的微信中会有一个title导航，35为title导航的高度*/
                                topHeight = topHeight - 35;
                                css('top', topHeight);
                            } else {
                                css('top', 0);
                            }
                            html('<img border=0 src=' + currImg.attr('src') + '>');
                        } else {
                            css('top', 0);
                            html('<img border=0 src=' + currImg.attr('src') + ' height=' + windowHeight + '>');
                        }
                    } else {
                        var currImgChangeHeight = (currImgHeight * windowWidth) / currImgWidth;
                        if (currImgChangeHeight < windowHeight) {
                            var topHeight = (windowHeight - currImgChangeHeight) / 2;
                            if (topHeight > 35) {
                                topHeight = topHeight - 35;
                                css('top', topHeight);
                            } else {
                                css('top', 0);
                            }
                            html('<img border=0 src=' + currImg.attr('src') + ' width=' + windowWidth + ';>');
                        } else {
                            css('top', 0);
                            html('<img border=0 src=' + currImg.attr('src') + ' width=' + windowWidth + '; height=' + windowHeight + '>');
                        }
                    }
                }
                tempContainer.click(function() {
                    $(this).remove();
                    coverLayer(0);
                });
            });
        });
    } else {
        return false;
    }
    //使用禁用蒙层效果
    function coverLayer(tag) {
        with($('.over')) {
            if (tag == 1) {
                css('height', $(document).height());
                css('display', 'block');
                css('opacity', 1);
                css("background-color", "#FFFFFF");
                css("background-color", "rgba(0,0,0,0.7)"); //蒙层透明度
            } else {
                css('display', 'none');
            }
        }
    }
});
// $(function () {
//     $(".dropdown").mouseover(function () {
//         $(this).addClass("open");
//     });
//     $(".dropdown").mouseleave(function(){
//         $(this).removeClass("open");
//     })
// })
$(function () {
    $('#WeChat').click(function () {
        $('.wx').toggle('slow');
    });
});
$(function(){
    $('.directory>li').click(function () {
        $(this).addClass('act').siblings('li').removeClass('act');
        $(this).find('.submenu').toggle('1500');
        $(this).find('i').toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
    })
});
$(function () {
    $('#check').click(function () {
        var name=$('#names').val();
        var mail=$('#mail').val();
        var titles=$('#titles').val();
        var tel=$('#tel').val();
        var yzm=$('#yzm').val();
        if(name ==  null || name == ''){
            alert("Name cannot be empty");
            return false;
        };
        if(mail ==  null || mail == ''){
            alert("Email cannot be empty");
            return false;
        };
        if(titles ==  null || titles == ''){
            alert("Topic cannot be empty");
            return false;
        };
        if(yzm ==  null || yzm == ''){
            alert("Please enter the verification code!");
            return false;
        };
    })
})
    $(function () {
        $('#verifyfid').click(function () {
            var names=$('#Name').val();
            var mailbox=$('#mailbox').val();
            var phone=$('#phone').val();
            var content=$('#content').val();
            var verifyf=$('#verifyf').val();
            if(names ==  null || names == ''){
                alert("Name cannot be empty");
                return false;
            }; 
           if(mailbox ==  null || mailbox == ''){
                alert("Email cannot be empty");
                return false;
            };
            if(verifyf ==  null || verifyf == ''){
                alert("Please enter the verification code!");
                return false;
            };
        })
    })