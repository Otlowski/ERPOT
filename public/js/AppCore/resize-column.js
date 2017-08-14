(function(){
    "use strict";

    var resize;

    resize = {

        changeBoxWidth: function (element){
            var newWidth,
                setWidth,
                box = element.parentNode,
                boxInfo = box.getBoundingClientRect();

            setWidth = function (ev) {
                newWidth = (boxInfo.width + ev.clientX - boxInfo.right) + 'px';
                box.style.flex = '0 0 ' + newWidth;
            };

            document.addEventListener('mousemove', setWidth);
            document.addEventListener('mouseup', function () {
                //localStorage.setItem('resizableElements', JSON.stringify(resizableElements));
                document.removeEventListener('mousemove',setWidth);

            });
        },


        //attachedEvents: function() {
        //    var i,
        //        that = this,
        //        resizableElement = document.querySelectorAll('[data-resize="true"]');
        //
        //    for (i = 0; i < resizableElement.length; i++) {
        //        resizableElement[i].addEventListener('mousedown', function(){
        //            that.changeBoxWidth(this);
        //        })
        //    }
        //},
        getBoxes: function () {
            var i,
                that = this,
                box,
                singleBox,
                boxesData = [],
                resizableElement = document.querySelectorAll('[data-resize="true"]');

            for (i = 0; i < resizableElement.length; i++) {
                resizableElement[i].addEventListener('mousedown', function(){
                    that.changeBoxWidth(this);
                });

                box = resizableElement[i].parentNode.getBoundingClientRect();
                singleBox = {
                    'width': box.width,
                    'url': 'index.html',
                    'order': resizableElement[i].getAttribute('data-resize-order')
                }

                boxesData.push(singleBox);
            }
            localStorage.setItem('resizableElements', JSON.stringify(boxesData));
            return boxesData;
        },
        init: function(){
            var that = this;

            //that.attachedEvents();
            that.getBoxes();
            //console.log( JSON.parse(localStorage.getItem('resizableElements')));
        }
    };

    document.addEventListener("DOMContentLoaded", function(event) {
        resize.init();


        $('.scrollbar').perfectScrollbar();
    });



}());