/* global screenReaderText */
/**
 * Theme navigation configuration
 *
 * Contains handlers for navigation.
 */
import $ from "jquery";
import MotionUI from "motion-ui";

/**
 *
 */
function toggleAnimation(ele, button, showAnimation, hideAnimation) {
  if (ele.hasClass("is-active")) {
    button.removeClass("menu-active");
    MotionUI.animateOut(ele, hideAnimation, function() {
      button.removeClass("toggled-on");
      ele.removeClass("is-active");
      ele.attr("style", "");
    });
  } else {
    button.addClass("menu-active");
    MotionUI.animateIn(ele, showAnimation, function() {
      button.addClass("toggled-on");
      ele.addClass("is-active");
      ele.attr("style", "");
    });
  }
}

initMainNavigation($(".main-navigation"));
