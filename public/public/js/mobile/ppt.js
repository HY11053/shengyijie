(function (doc, win, undefined) {
  "use strict";
  var swipMinDistance = 20;
  var urlHeight = 44;
  var swipIndex = 0;
  var lastHeight = 0;
  var resizeTimer = null;
  var currentWidth;
  var currentHeight;
  var assistHideBar = F.m.one("assist_hide_bar");
  var picBox = F.m.one("pic_box");
  var picSlider = F.m.one("pic_slider");
  var sliderItems = F.m.query("#pic_slider div");
  var sliderCount = sliderItems.length;
  var contentInfo = F.m.one("content_info");
  var contentIndex = F.m.one("content_index");
  
 
  

  var commentCount = F.m.one("comment_count");
  var isMombile = (function () {
    return "ontouchstart" in win;
  }());
  
  var init = function () {
    resetScreen();
    resizePicBox();
    changeContent();

    initEvent();


  };
  
  var initEvent = function () {
    F.m.addEvent(win, "orientationchange", resetScreen);
    F.m.addEvent(win, "resize", resizePicBox);
    F.m.toggle(picBox, miniContent, fullContent);
  
    F.m.tap(doc.body, closeShare);
    F.m.tap(doc.body, localTo);
   
   
    F.m.swip(picSlider, sliderMovBegin, sliderMoving, sliderMoveEnd, changeContentByTransition);
  };

  
  var resetScreen = function () {
    resetPicBox();
    setTimeout(function () {
      hideUrl();
      resizeSliderWidth();
    }, F.m.device === "ios" ? 0 : 600); 
  };
  var hideUrl = function () {
    assistHideBar.style.height = (win.innerHeight + urlHeight) + "px";
    scrollToTop();
    assistHideBar.style.height = win.innerHeight;
  };

  var scrollToTop = function () {
    win.scrollTo(0, 1);
  };

  var resetPicBox = function () {
    picBox.style.width = "auto";
    F.m.removeClass(picSlider, "anim");
  };
  
  var resizeSliderWidth = function () {
    var sliderItem;
    currentWidth = assistHideBar.offsetWidth;
    currentHeight = assistHideBar.offsetHeight;
    for (var i = 0; i < sliderCount; i++) {
      sliderItem = sliderItems[i];
      sliderItem.style.width = currentWidth + "px";
      sliderItem.style.height = currentHeight + "px";
    }
    picBox.style.width = currentWidth + "px";
    picSlider.style.width = currentWidth * sliderCount + "px";
    addCssTransform(0);
  };
  
  var resizePicBoxIos = function () {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function () {
      resizePicBoxCommon();
    }, 100);
  };
  
  var resizePicBoxOthersSystem = function () {
    resizePicBoxCommon();
  };
  var resizePicBoxCommon = function () {
    var picBoxHeight = win.innerHeight;
    var canResize = false;
    if (picBoxHeight !== lastHeight) {
      if (Math.abs(picBoxHeight - lastHeight) > 110) {
        canResize = true;
      } else if (picBoxHeight > lastHeight) {
        canResize = true;
      }
    }
    
    if (canResize) {
      picBox.style.height = picBoxHeight-100 + "px";
      lastHeight = picBoxHeight;
    }
  };
  
  var resizePicBox = F.m.device === "ios" ? resizePicBoxIos : resizePicBoxOthersSystem;
  var miniContent = function () {
    F.m.addClass(doc.body, "mini_viewport");
    scrollToTop();
  };

  var fullContent = function () {
    F.m.removeClass(doc.body, "mini_viewport");
    scrollToTop();
  };

  

  

  var closeShare  = function (e) {
    var target = e.target;

    while (target !== doc.body) {

      if (target.id === "share_box" ||
          (target.id === "share_btn" && !F.m.hasClass(target, "share_active"))) {
        return;
      }

      target = target.parentNode;
    }

    hideShareBox();
  };
  
  var localTo = function (e) {
    var btn = e.target;
    var url;
    var target;

    while (btn !== doc.body) {

      if (btn.getAttribute("data-url") !== null) {
        target = btn.getAttribute("data-target");
        url = btn.getAttribute("data-url");

        if (url !== null) {

          if (target === "blank") {
            window.open(url, "", "");
          } else {
            win.location = url;
          }

          return false;
        }

      }

      btn = btn.parentNode;
    }

  };
  


  

  var sliderMovBegin = function () {
    F.m.removeClass(picSlider, "anim");
  };
  
  var sliderMoving = function (beginX, movX) {
    var distance = beginX - movX;
    addCssTransform(distance);
    if (sliderCount === swipIndex + 1 && distance > swipMinDistance) {
      turnPage("next");
    }
    if (swipIndex === 0 && distance < -swipMinDistance) {
      turnPage("prev");
    }
    return false;
  };
  
  var sliderMoveEnd = function (beginX, endX) {

    var distance = beginX - endX;
    F.m.addClass(picSlider, "anim");
    if (distance > swipMinDistance && sliderCount !== swipIndex + 1) {
      addCssTransform(currentWidth);
      swipIndex++;
      if (!isMombile) {
        changeContent("next");
      
      }
      
      return;
    }
    
    if (distance < -swipMinDistance && swipIndex !== 0) {
      addCssTransform(-currentWidth);
      swipIndex--;
      if (!isMombile) {
        changeContent("prev");
      
      }
      return;
    }
    
    addCssTransform(0);

  };
  
  var transformStyleName = F.m.prefixStyle("transform");
  var addCssTransform = function (distance) {
    picSlider.style[transformStyleName] = "translate3d(" + (-swipIndex * currentWidth - distance) + "px, 0, 0)";
  };
  var turnPage = function (direction) {
    if (direction === "next" && typeof nextLocation !== "undefined") {
      win.location = nextLocation ;
      return;
    }
    if (direction === "prev" && typeof prevLocation !== "undefined") {
      win.location = prevLocation;
      return;
    }
  };
  
  var changeContentByTransition = function (beginX, endX) {
    if (isMombile && Math.abs(beginX - endX) > swipMinDistance) {
      changeContent("next");
    
    }
  };

  var changeContent = function (direction) {
    changeContentPic(direction);
    changeContentText();
    changeContentPage();
  };
  
  var changeContentText = function () {
    if (swipIndex % 2) {
      contentInfo.style.color = "#5d5d5d";
    } else {
      contentInfo.style.color = "#5d5d5c";
    }

    contentInfo.innerHTML = descData[swipIndex];
  };
  
  var changeContentPage = function () {

    if (swipIndex % 2) {
      contentIndex.style.color = "#2C2C2C";
    } else {
      contentIndex.style.color = "#2C2C2D";
    }

    contentIndex.innerHTML = "[" + (swipIndex + 1) + "/" + sliderCount + "]";
  };
  
  var changeContentPic = function (direction) {
    direction = direction || "next";
    var adjacentIndex = direction === "next" ? swipIndex + 1 : swipIndex - 1;
    loadPicture(sliderItems[swipIndex]);
    loadPicture(sliderItems[adjacentIndex]);
  };
  
  var loadPicture = function (div) {
    var img;
    var src;
    var isLoading;
    if (typeof div !== "undefined") {
      src = div.getAttribute("data-src");
      isLoading = div.getAttribute("data-status");
      if (src !== "" && isLoading !== "loading") {
        img = document.createElement("img");
        div.setAttribute("data-static", "loading");
        img.onload = function () {
          div.style.backgroundImage = "url(" + src + ")";
          div.innerHTML = '<img src="' + src + '" ondragstart = "return false;"/>';
          div.setAttribute("data-src", "");
        };
        img.src = src;
      }

    }

  };


  

  init();
}(document, window));