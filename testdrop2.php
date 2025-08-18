<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>


<style>

#accordion {
    margin: 50px 0 0;
    font-family: "Poppins", sans-serif;
}

.accordion-tab {
    position: relative;
    width: 100%;
    max-width: 1000px;
    margin: 0 auto 10px; /* 10px adds to bottom */
    border-radius: 4px;
    background-color: #ffffff;
    box-shadow: 0 0 0 1px #ececec;
}
.accordion-tab:hover {
    box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.11);
}

.accordion-input {
    display: none;
}

.accordion-input:checked ~ .accordion-content + .accordion-tab-content {
    max-height: 3000px;
}

.accordion-input:checked ~ .accordion-content:after {
    transform: rotate(0);
}

.accordion-label {
    position: absolute;
    width: 100%;
    height: 100%;
    max-height: 80px;
    z-index: 1;
    cursor: pointer;
}

.accordion-content {
    position: relative;
    height: 40px;
    padding: 0 87px 0 30px;
    white-space: nowrap;
}

.accordion-content:before, .accordion-content:after {
    content: '';
    display: inline-block;
    vertical-align: middle;
}

.accordion-content:before {
    height: 100%;
}

.accordion-label:hover ~ .accordion-content:after {
  background-image: url("accordion-arrow-hover.svg");
}

.accordion-content:after {
    width: 24px;
    height: 100%;
    background-image: url("accordion-arrow.svg");
    background-repeat: no-repeat;
    background-position: center;
    transform: rotate(180deg);
}

.accordion-content + .accordion-tab-content {
    max-height: 0;
    overflow: hidden;
    transition: max-height .3s;
}

.accordion-content > div, .total-games > div {
    display: inline-block;
    vertical-align: middle;
}

.accordion-info {
    width: 95%;
}

.accordion-tab-content {
    background-color: #f9f9f9;
    color: #363636;
    font-size: 13px;
    font-weight: 400;
    border-radius: 0 0 4px 4px;
}

.wrapper {
  padding: 1px;
}

.platform-image {
    display: inline-block;
    height: 44px;
    width: 44px;
    border-radius: 50%;
    background-color: #e4e4e4;
    vertical-align: middle;
}

.platform-name {
    font-size: 14px;
    color: #242a32;
    width: 75%;
    margin-left: 16px;
    font-weight: 500;
    color: #242a32;
    vertical-align: middle;
}

.total-games {
    font-size: 14px;
    color: #5d5d5d;
}

.game-image {
    display: inline-block;
    height: 44px;
    width: 44px;
    border-radius: 50%;
    background-color: #e4e4e4;
    vertical-align: middle;
}

.game-name {
    font-size: 14px;
    color: #242a32;
    width: 75%;
    margin-left: 16px;
    font-weight: 500;
    color: #242a32;
    vertical-align: middle;
}</style>


<body>
 <div id="accordion" >
            <div class="accordion-tab">
                <input type="radio" id="radio-1" class="accordion-input" name="accordion">
                <label class="accordion-label" for="radio-1"></label>
                <div class="accordion-content">
                    <div class="accordion-info">
                        <!--<div class="platform-image"></div>-->
                        <span class="platform-name">Lorem ipsum</span>
                    </div>
                    <!--<div class="total-games">
                        <span>Lorem ipsum</span>
                    </div>-->
                </div>

                <div class="accordion-tab-content">
                    <div class="wrapper">
                        <div class="accordion-tab">
                            <input type="radio" id="radio-2" class="accordion-input" name="sub-accordion-1">
                            <label class="accordion-label" for="radio-2"></label>
                            <div class="accordion-content">
                                <div class="accordion-info">
                                    <!--<div class="game-image"></div>-->
                                    <span class="game-name">Lorem ipsum</span>
                                </div>
                               <!-- <div class="total-games">
                                    <span>Lorem ipsum</span>
                                </div>-->
                            </div>
                            <div class="accordion-tab-content">
                                <div class="wrapper">
                                    <div>
                                        <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin id congue dolor. Vivamus eleifend vitae nunc sed tincidunt.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion-tab">
                <input type="radio" id="radio-3" class="accordion-input" name="accordion">
                <label class="accordion-label" for="radio-3"></label>
                <div class="accordion-content">
                    <div class="accordion-info">
                        <!--<div class="platform-image"></div>-->
                        <span class="platform-name">Lorem ipsum</span>
                    </div>
                    <!--<div class="total-games">
                        <span>Lorem ipsum</span>
                    </div>-->
                </div>

                <div class="accordion-tab-content">
                    <div class="wrapper">
                        <div class="accordion-tab">
                            <input type="radio" id="radio-4" class="accordion-input" name="sub-accordion-2">
                            <label class="accordion-label" for="radio-4"></label>
                            <div class="accordion-content">
                                <div class="accordion-info">
                                   <!-- <div class="game-image"></div>-->
                                    <span class="game-name">Lorem ipsum</span>
                                </div>
                               <!-- <div class="total-games">
                                    <span>Lorem ipsum</span>
                                </div>-->
                            </div>
                            <div class="accordion-tab-content">
                                <div class="wrapper">
                                    <div>
                                        <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin id congue dolor. Vivamus eleifend vitae nunc sed tincidunt.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                      <div class="accordion-tab">
                            <input type="radio" id="radio-5" class="accordion-input" name="sub-accordion-2">
                            <label class="accordion-label" for="radio-5"></label>
                            <div class="accordion-content">
                                <div class="accordion-info">
                                   <!-- <div class="game-image"></div>-->
                                    <span class="game-name">Lorem ipsum</span>
                                </div>
                                <!--<div class="total-games">
                                    <span>Lorem ipsum</span>
                                </div>-->
                            </div>
                            <div class="accordion-tab-content">
                                <div class="wrapper">
                                    <div>
                                        <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin id congue dolor. Vivamus eleifend vitae nunc sed tincidunt.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</body>
</html>
