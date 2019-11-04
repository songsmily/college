<html lang="zh-CN">
<head>
    <style class="vjs-styles-defaults">
        .video-js {
            width: 300px;
            height: 150px;
        }

        .vjs-fluid {
            padding-top: 56.25%
        }
    </style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Lei Shi">
    <meta http-equiv="Cache-Control" content="o-transform">
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <meta name="csrf-token" content="1483780974##87f89328c5616669f00302a263fe9061bb852818">


    <title>社团报名系统</title>

    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="{{asset("resources/views/static/font-awesome//4.7.0/css/font-awesome.min.css")}}">
    <link rel="stylesheet" href="{{asset("resources/views/app/css/libs/bootstrap/3.3.7/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("resources/views/app/css/dest/styles.css?=2016121272249")}}">

    <style>
        @font-face {
            font-family: "lantingxihei";
            src: url("fonts/FZLTCXHJW.TTF");
        }

        /* modal 模态框*/
        #invite-user .modal-body {
            overflow: hidden;
        }

        #invite-user .modal-body .form-label {
            margin-bottom: 16px;
            font-size: 14px;
        }

        #invite-user .modal-body .form-invite {
            width: 80%;
            padding: 6px 12px;
            background-color: #eeeeee;
            border: 1px solid #cccccc;
            border-radius: 5px;
            float: left;
            margin-right: 10px;
        }

        #invite-user .modal-body .msg-modal-style {
            background-color: #7dd383;
            margin-top: 10px;
            padding: 6px 0;
            text-align: center;
            width: 100%;
        }

        #invite-user .modal-body .modal-flash {
            position: absolute;
            top: 53px;
            right: 74px;
            z-index: 999;
        }

        /* end modal */

        .en-footer {
            padding: 30px;
            text-align: center;
            font-size: 14px;
        }
    </style>


    <style id="ace_editor.css">
        .ace_editor {
            position: relative;
            overflow: hidden;
            font: 12px/normal 'Monaco', 'Menlo', 'Ubuntu Mono', 'Consolas', 'source-code-pro', monospace;
            direction: ltr;
            text-align: left;
        }

        .ace_scroller {
            position: absolute;
            overflow: hidden;
            top: 0;
            bottom: 0;
            background-color: inherit;
            -ms-user-select: none;
            -moz-user-select: none;
            -webkit-user-select: none;
            user-select: none;
            cursor: text;
        }

        .ace_content {
            position: absolute;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            min-width: 100%;
        }

        .ace_dragging .ace_scroller:before {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            content: '';
            background: rgba(250, 250, 250, 0.01);
            z-index: 1000;
        }

        .ace_dragging.ace_dark .ace_scroller:before {
            background: rgba(0, 0, 0, 0.01);
        }

        .ace_selecting, .ace_selecting * {
            cursor: text !important;
        }

        .ace_gutter {
            position: absolute;
            overflow: hidden;
            width: auto;
            top: 0;
            bottom: 0;
            left: 0;
            cursor: default;
            z-index: 4;
            -ms-user-select: none;
            -moz-user-select: none;
            -webkit-user-select: none;
            user-select: none;
        }

        .ace_gutter-active-line {
            position: absolute;
            left: 0;
            right: 0;
        }

        .ace_scroller.ace_scroll-left {
            box-shadow: 17px 0 16px -16px rgba(0, 0, 0, 0.4) inset;
        }

        .ace_gutter-cell {
            padding-left: 19px;
            padding-right: 6px;
            background-repeat: no-repeat;
        }

        .ace_gutter-cell.ace_error {
            background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAABOFBMVEX/////////QRswFAb/Ui4wFAYwFAYwFAaWGAfDRymzOSH/PxswFAb/SiUwFAYwFAbUPRvjQiDllog5HhHdRybsTi3/Tyv9Tir+Syj/UC3////XurebMBIwFAb/RSHbPx/gUzfdwL3kzMivKBAwFAbbvbnhPx66NhowFAYwFAaZJg8wFAaxKBDZurf/RB6mMxb/SCMwFAYwFAbxQB3+RB4wFAb/Qhy4Oh+4QifbNRcwFAYwFAYwFAb/QRzdNhgwFAYwFAbav7v/Uy7oaE68MBK5LxLewr/r2NXewLswFAaxJw4wFAbkPRy2PyYwFAaxKhLm1tMwFAazPiQwFAaUGAb/QBrfOx3bvrv/VC/maE4wFAbRPBq6MRO8Qynew8Dp2tjfwb0wFAbx6eju5+by6uns4uH9/f36+vr/GkHjAAAAYnRSTlMAGt+64rnWu/bo8eAA4InH3+DwoN7j4eLi4xP99Nfg4+b+/u9B/eDs1MD1mO7+4PHg2MXa347g7vDizMLN4eG+Pv7i5evs/v79yu7S3/DV7/498Yv24eH+4ufQ3Ozu/v7+y13sRqwAAADLSURBVHjaZc/XDsFgGIBhtDrshlitmk2IrbHFqL2pvXf/+78DPokj7+Fz9qpU/9UXJIlhmPaTaQ6QPaz0mm+5gwkgovcV6GZzd5JtCQwgsxoHOvJO15kleRLAnMgHFIESUEPmawB9ngmelTtipwwfASilxOLyiV5UVUyVAfbG0cCPHig+GBkzAENHS0AstVF6bacZIOzgLmxsHbt2OecNgJC83JERmePUYq8ARGkJx6XtFsdddBQgZE2nPR6CICZhawjA4Fb/chv+399kfR+MMMDGOQAAAABJRU5ErkJggg==");
            background-repeat: no-repeat;
            background-position: 2px center;
        }

        .ace_gutter-cell.ace_warning {
            background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAmVBMVEX///8AAAD///8AAAAAAABPSzb/5sAAAAB/blH/73z/ulkAAAAAAAD85pkAAAAAAAACAgP/vGz/rkDerGbGrV7/pkQICAf////e0IsAAAD/oED/qTvhrnUAAAD/yHD/njcAAADuv2r/nz//oTj/p064oGf/zHAAAAA9Nir/tFIAAAD/tlTiuWf/tkIAAACynXEAAAAAAAAtIRW7zBpBAAAAM3RSTlMAABR1m7RXO8Ln31Z36zT+neXe5OzooRDfn+TZ4p3h2hTf4t3k3ucyrN1K5+Xaks52Sfs9CXgrAAAAjklEQVR42o3PbQ+CIBQFYEwboPhSYgoYunIqqLn6/z8uYdH8Vmdnu9vz4WwXgN/xTPRD2+sgOcZjsge/whXZgUaYYvT8QnuJaUrjrHUQreGczuEafQCO/SJTufTbroWsPgsllVhq3wJEk2jUSzX3CUEDJC84707djRc5MTAQxoLgupWRwW6UB5fS++NV8AbOZgnsC7BpEAAAAABJRU5ErkJggg==");
            background-position: 2px center;
        }

        .ace_gutter-cell.ace_info {
            background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAAAAAA6mKC9AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAAJ0Uk5TAAB2k804AAAAPklEQVQY02NgIB68QuO3tiLznjAwpKTgNyDbMegwisCHZUETUZV0ZqOquBpXj2rtnpSJT1AEnnRmL2OgGgAAIKkRQap2htgAAAAASUVORK5CYII=");
            background-position: 2px center;
        }

        .ace_dark .ace_gutter-cell.ace_info {
            background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQBAMAAADt3eJSAAAAJFBMVEUAAAChoaGAgIAqKiq+vr6tra1ZWVmUlJSbm5s8PDxubm56enrdgzg3AAAAAXRSTlMAQObYZgAAAClJREFUeNpjYMAPdsMYHegyJZFQBlsUlMFVCWUYKkAZMxZAGdxlDMQBAG+TBP4B6RyJAAAAAElFTkSuQmCC");
        }

        .ace_scrollbar {
            position: absolute;
            right: 0;
            bottom: 0;
            z-index: 6;
        }

        .ace_scrollbar-inner {
            position: absolute;
            cursor: text;
            left: 0;
            top: 0;
        }

        .ace_scrollbar-v {
            overflow-x: hidden;
            overflow-y: scroll;
            top: 0;
        }

        .ace_scrollbar-h {
            overflow-x: scroll;
            overflow-y: hidden;
            left: 0;
        }

        .ace_print-margin {
            position: absolute;
            height: 100%;
        }

        .ace_text-input {
            position: absolute;
            z-index: 0;
            width: 0.5em;
            height: 1em;
            opacity: 0;
            background: transparent;
            -moz-appearance: none;
            appearance: none;
            border: none;
            resize: none;
            outline: none;
            overflow: hidden;
            font: inherit;
            padding: 0 1px;
            margin: 0 -1px;
            text-indent: -1em;
            -ms-user-select: text;
            -moz-user-select: text;
            -webkit-user-select: text;
            user-select: text;
            white-space: pre !important;
        }

        .ace_text-input.ace_composition {
            background: inherit;
            color: inherit;
            z-index: 1000;
            opacity: 1;
            text-indent: 0;
        }

        .ace_layer {
            z-index: 1;
            position: absolute;
            overflow: hidden;
            word-wrap: normal;
            white-space: pre;
            height: 100%;
            width: 100%;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            pointer-events: none;
        }

        .ace_gutter-layer {
            position: relative;
            width: auto;
            text-align: right;
            pointer-events: auto;
        }

        .ace_text-layer {
            font: inherit !important;
        }

        .ace_cjk {
            display: inline-block;
            text-align: center;
        }

        .ace_cursor-layer {
            z-index: 4;
        }

        .ace_cursor {
            z-index: 4;
            position: absolute;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            border-left: 2px solid;
            transform: translatez(0);
        }

        .ace_slim-cursors .ace_cursor {
            border-left-width: 1px;
        }

        .ace_overwrite-cursors .ace_cursor {
            border-left-width: 0;
            border-bottom: 1px solid;
        }

        .ace_hidden-cursors .ace_cursor {
            opacity: 0.2;
        }

        .ace_smooth-blinking .ace_cursor {
            -webkit-transition: opacity 0.18s;
            transition: opacity 0.18s;
        }

        .ace_editor.ace_multiselect .ace_cursor {
            border-left-width: 1px;
        }

        .ace_marker-layer .ace_step, .ace_marker-layer .ace_stack {
            position: absolute;
            z-index: 3;
        }

        .ace_marker-layer .ace_selection {
            position: absolute;
            z-index: 5;
        }

        .ace_marker-layer .ace_bracket {
            position: absolute;
            z-index: 6;
        }

        .ace_marker-layer .ace_active-line {
            position: absolute;
            z-index: 2;
        }

        .ace_marker-layer .ace_selected-word {
            position: absolute;
            z-index: 4;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        .ace_line .ace_fold {
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            display: inline-block;
            height: 11px;
            margin-top: -2px;
            vertical-align: middle;
            background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAAJCAYAAADU6McMAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAJpJREFUeNpi/P//PwOlgAXGYGRklAVSokD8GmjwY1wasKljQpYACtpCFeADcHVQfQyMQAwzwAZI3wJKvCLkfKBaMSClBlR7BOQikCFGQEErIH0VqkabiGCAqwUadAzZJRxQr/0gwiXIal8zQQPnNVTgJ1TdawL0T5gBIP1MUJNhBv2HKoQHHjqNrA4WO4zY0glyNKLT2KIfIMAAQsdgGiXvgnYAAAAASUVORK5CYII="), url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAA3CAYAAADNNiA5AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACJJREFUeNpi+P//fxgTAwPDBxDxD078RSX+YeEyDFMCIMAAI3INmXiwf2YAAAAASUVORK5CYII=");
            background-repeat: no-repeat, repeat-x;
            background-position: center center, top left;
            color: transparent;
            border: 1px solid black;
            border-radius: 2px;
            cursor: pointer;
            pointer-events: auto;
        }

        .ace_dark .ace_fold {
        }

        .ace_fold:hover {
            background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAAJCAYAAADU6McMAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAJpJREFUeNpi/P//PwOlgAXGYGRklAVSokD8GmjwY1wasKljQpYACtpCFeADcHVQfQyMQAwzwAZI3wJKvCLkfKBaMSClBlR7BOQikCFGQEErIH0VqkabiGCAqwUadAzZJRxQr/0gwiXIal8zQQPnNVTgJ1TdawL0T5gBIP1MUJNhBv2HKoQHHjqNrA4WO4zY0glyNKLT2KIfIMAAQsdgGiXvgnYAAAAASUVORK5CYII="), url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAA3CAYAAADNNiA5AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAACBJREFUeNpi+P//fz4TAwPDZxDxD5X4i5fLMEwJgAADAEPVDbjNw87ZAAAAAElFTkSuQmCC");
        }

        .ace_tooltip {
            background-color: #FFF;
            background-image: -webkit-linear-gradient(top, transparent, rgba(0, 0, 0, 0.1));
            background-image: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.1));
            border: 1px solid gray;
            border-radius: 1px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
            color: black;
            max-width: 100%;
            padding: 3px 4px;
            position: fixed;
            z-index: 999999;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            cursor: default;
            white-space: pre;
            word-wrap: break-word;
            line-height: normal;
            font-style: normal;
            font-weight: normal;
            letter-spacing: normal;
            pointer-events: none;
        }

        .ace_folding-enabled > .ace_gutter-cell {
            padding-right: 13px;
        }

        .ace_fold-widget {
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            margin: 0 -12px 0 1px;
            display: none;
            width: 11px;
            vertical-align: top;
            background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAUAAAAFCAYAAACNbyblAAAANElEQVR42mWKsQ0AMAzC8ixLlrzQjzmBiEjp0A6WwBCSPgKAXoLkqSot7nN3yMwR7pZ32NzpKkVoDBUxKAAAAABJRU5ErkJggg==");
            background-repeat: no-repeat;
            background-position: center;
            border-radius: 3px;
            border: 1px solid transparent;
            cursor: pointer;
        }

        .ace_folding-enabled .ace_fold-widget {
            display: inline-block;
        }

        .ace_fold-widget.ace_end {
            background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAUAAAAFCAYAAACNbyblAAAANElEQVR42m3HwQkAMAhD0YzsRchFKI7sAikeWkrxwScEB0nh5e7KTPWimZki4tYfVbX+MNl4pyZXejUO1QAAAABJRU5ErkJggg==");
        }

        .ace_fold-widget.ace_closed {
            background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAMAAAAGCAYAAAAG5SQMAAAAOUlEQVR42jXKwQkAMAgDwKwqKD4EwQ26sSOkVWjgIIHAzPiCgaqiqnJHZnKICBERHN194O5b9vbLuAVRL+l0YWnZAAAAAElFTkSuQmCCXA==");
        }

        .ace_fold-widget:hover {
            border: 1px solid rgba(0, 0, 0, 0.3);
            background-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 1px 1px rgba(255, 255, 255, 0.7);
        }

        .ace_fold-widget:active {
            border: 1px solid rgba(0, 0, 0, 0.4);
            background-color: rgba(0, 0, 0, 0.05);
            box-shadow: 0 1px 1px rgba(255, 255, 255, 0.8);
        }

        .ace_dark .ace_fold-widget {
            background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAUAAAAFCAYAAACNbyblAAAAHklEQVQIW2P4//8/AzoGEQ7oGCaLLAhWiSwB146BAQCSTPYocqT0AAAAAElFTkSuQmCC");
        }

        .ace_dark .ace_fold-widget.ace_end {
            background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAUAAAAFCAYAAACNbyblAAAAH0lEQVQIW2P4//8/AxQ7wNjIAjDMgC4AxjCVKBirIAAF0kz2rlhxpAAAAABJRU5ErkJggg==");
        }

        .ace_dark .ace_fold-widget.ace_closed {
            background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAMAAAAFCAYAAACAcVaiAAAAHElEQVQIW2P4//+/AxAzgDADlOOAznHAKgPWAwARji8UIDTfQQAAAABJRU5ErkJggg==");
        }

        .ace_dark .ace_fold-widget:hover {
            box-shadow: 0 1px 1px rgba(255, 255, 255, 0.2);
            background-color: rgba(255, 255, 255, 0.1);
        }

        .ace_dark .ace_fold-widget:active {
            box-shadow: 0 1px 1px rgba(255, 255, 255, 0.2);
        }

        .ace_fold-widget.ace_invalid {
            background-color: #FFB4B4;
            border-color: #DE5555;
        }

        .ace_fade-fold-widgets .ace_fold-widget {
            -webkit-transition: opacity 0.4s ease 0.05s;
            transition: opacity 0.4s ease 0.05s;
            opacity: 0;
        }

        .ace_fade-fold-widgets:hover .ace_fold-widget {
            -webkit-transition: opacity 0.05s ease 0.05s;
            transition: opacity 0.05s ease 0.05s;
            opacity: 1;
        }

        .ace_underline {
            text-decoration: underline;
        }

        .ace_bold {
            font-weight: bold;
        }

        .ace_nobold .ace_bold {
            font-weight: normal;
        }

        .ace_italic {
            font-style: italic;
        }

        .ace_error-marker {
            background-color: rgba(255, 0, 0, 0.2);
            position: absolute;
            z-index: 9;
        }

        .ace_highlight-marker {
            background-color: rgba(255, 255, 0, 0.2);
            position: absolute;
            z-index: 8;
        }

        .ace_br1 {
            border-top-left-radius: 3px;
        }

        .ace_br2 {
            border-top-right-radius: 3px;
        }

        .ace_br3 {
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
        }

        .ace_br4 {
            border-bottom-right-radius: 3px;
        }

        .ace_br5 {
            border-top-left-radius: 3px;
            border-bottom-right-radius: 3px;
        }

        .ace_br6 {
            border-top-right-radius: 3px;
            border-bottom-right-radius: 3px;
        }

        .ace_br7 {
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
            border-bottom-right-radius: 3px;
        }

        .ace_br8 {
            border-bottom-left-radius: 3px;
        }

        .ace_br9 {
            border-top-left-radius: 3px;
            border-bottom-left-radius: 3px;
        }

        .ace_br10 {
            border-top-right-radius: 3px;
            border-bottom-left-radius: 3px;
        }

        .ace_br11 {
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
            border-bottom-left-radius: 3px;
        }

        .ace_br12 {
            border-bottom-right-radius: 3px;
            border-bottom-left-radius: 3px;
        }

        .ace_br13 {
            border-top-left-radius: 3px;
            border-bottom-right-radius: 3px;
            border-bottom-left-radius: 3px;
        }

        .ace_br14 {
            border-top-right-radius: 3px;
            border-bottom-right-radius: 3px;
            border-bottom-left-radius: 3px;
        }

        .ace_br15 {
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
            border-bottom-right-radius: 3px;
            border-bottom-left-radius: 3px;
        }

        /*# sourceURL=ace/css/ace_editor.css */</style>
    <style id="ace-tm">
        .ace-tm .ace_gutter {
            background: #f0f0f0;
            color: #333;
        }

        .ace-tm .ace_print-margin {
            width: 1px;
            background: #e8e8e8;
        }

        .ace-tm .ace_fold {
            background-color: #6B72E6;
        }

        .ace-tm {
            background-color: #FFFFFF;
            color: black;
        }

        .ace-tm .ace_cursor {
            color: black;
        }

        .ace-tm .ace_invisible {
            color: rgb(191, 191, 191);
        }

        .ace-tm .ace_storage, .ace-tm .ace_keyword {
            color: blue;
        }

        .ace-tm .ace_constant {
            color: rgb(197, 6, 11);
        }

        .ace-tm .ace_constant.ace_buildin {
            color: rgb(88, 72, 246);
        }

        .ace-tm .ace_constant.ace_language {
            color: rgb(88, 92, 246);
        }

        .ace-tm .ace_constant.ace_library {
            color: rgb(6, 150, 14);
        }

        .ace-tm .ace_invalid {
            background-color: rgba(255, 0, 0, 0.1);
            color: red;
        }

        .ace-tm .ace_support.ace_function {
            color: rgb(60, 76, 114);
        }

        .ace-tm .ace_support.ace_constant {
            color: rgb(6, 150, 14);
        }

        .ace-tm .ace_support.ace_type, .ace-tm .ace_support.ace_class {
            color: rgb(109, 121, 222);
        }

        .ace-tm .ace_keyword.ace_operator {
            color: rgb(104, 118, 135);
        }

        .ace-tm .ace_string {
            color: rgb(3, 106, 7);
        }

        .ace-tm .ace_comment {
            color: rgb(76, 136, 107);
        }

        .ace-tm .ace_comment.ace_doc {
            color: rgb(0, 102, 255);
        }

        .ace-tm .ace_comment.ace_doc.ace_tag {
            color: rgb(128, 159, 191);
        }

        .ace-tm .ace_constant.ace_numeric {
            color: rgb(0, 0, 205);
        }

        .ace-tm .ace_variable {
            color: rgb(49, 132, 149);
        }

        .ace-tm .ace_xml-pe {
            color: rgb(104, 104, 91);
        }

        .ace-tm .ace_entity.ace_name.ace_function {
            color: #0000A2;
        }

        .ace-tm .ace_heading {
            color: rgb(12, 7, 255);
        }

        .ace-tm .ace_list {
            color: rgb(185, 6, 144);
        }

        .ace-tm .ace_meta.ace_tag {
            color: rgb(0, 22, 142);
        }

        .ace-tm .ace_string.ace_regex {
            color: rgb(255, 0, 0)
        }

        .ace-tm .ace_marker-layer .ace_selection {
            background: rgb(181, 213, 255);
        }

        .ace-tm.ace_multiselect .ace_selection.ace_start {
            box-shadow: 0 0 3px 0px white;
        }

        .ace-tm .ace_marker-layer .ace_step {
            background: rgb(252, 255, 0);
        }

        .ace-tm .ace_marker-layer .ace_stack {
            background: rgb(164, 229, 101);
        }

        .ace-tm .ace_marker-layer .ace_bracket {
            margin: -1px 0 0 -1px;
            border: 1px solid rgb(192, 192, 192);
        }

        .ace-tm .ace_marker-layer .ace_active-line {
            background: rgba(0, 0, 0, 0.07);
        }

        .ace-tm .ace_gutter-active-line {
            background-color: #dcdcdc;
        }

        .ace-tm .ace_marker-layer .ace_selected-word {
            background: rgb(250, 250, 255);
            border: 1px solid rgb(200, 200, 250);
        }

        .ace-tm .ace_indent-guide {
            background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAACCAYAAACZgbYnAAAAE0lEQVQImWP4////f4bLly//BwAmVgd1/w11/gAAAABJRU5ErkJggg==") right repeat-y;
        }

        /*# sourceURL=ace/css/ace-tm */</style>
    <style>
        .error_widget_wrapper {
            background: inherit;
            color: inherit;
            border: none
        }

        .error_widget {
            border-top: solid 2px;
            border-bottom: solid 2px;
            margin: 5px 0;
            padding: 10px 40px;
            white-space: pre-wrap;
        }

        .error_widget.ace_error, .error_widget_arrow.ace_error {
            border-color: #ff5a5a
        }

        .error_widget.ace_warning, .error_widget_arrow.ace_warning {
            border-color: #F1D817
        }

        .error_widget.ace_info, .error_widget_arrow.ace_info {
            border-color: #5a5a5a
        }

        .error_widget.ace_ok, .error_widget_arrow.ace_ok {
            border-color: #5aaa5a
        }

        .error_widget_arrow {
            position: absolute;
            border: solid 5px;
            border-top-color: transparent !important;
            border-right-color: transparent !important;
            border-left-color: transparent !important;
            top: -5px;
        }</style>
    <style>
        .error_widget_wrapper {
            background: inherit;
            color: inherit;
            border: none
        }

        .error_widget {
            border-top: solid 2px;
            border-bottom: solid 2px;
            margin: 5px 0;
            padding: 10px 40px;
            white-space: pre-wrap;
        }

        .error_widget.ace_error, .error_widget_arrow.ace_error {
            border-color: #ff5a5a
        }

        .error_widget.ace_warning, .error_widget_arrow.ace_warning {
            border-color: #F1D817
        }

        .error_widget.ace_info, .error_widget_arrow.ace_info {
            border-color: #5a5a5a
        }

        .error_widget.ace_ok, .error_widget_arrow.ace_ok {
            border-color: #5aaa5a
        }

        .error_widget_arrow {
            position: absolute;
            border: solid 5px;
            border-top-color: transparent !important;
            border-right-color: transparent !important;
            border-left-color: transparent !important;
            top: -5px;
        }</style>
    <style>
        .error_widget_wrapper {
            background: inherit;
            color: inherit;
            border: none
        }

        .error_widget {
            border-top: solid 2px;
            border-bottom: solid 2px;
            margin: 5px 0;
            padding: 10px 40px;
            white-space: pre-wrap;
        }

        .error_widget.ace_error, .error_widget_arrow.ace_error {
            border-color: #ff5a5a
        }

        .error_widget.ace_warning, .error_widget_arrow.ace_warning {
            border-color: #F1D817
        }

        .error_widget.ace_info, .error_widget_arrow.ace_info {
            border-color: #5a5a5a
        }

        .error_widget.ace_ok, .error_widget_arrow.ace_ok {
            border-color: #5aaa5a
        }

        .error_widget_arrow {
            position: absolute;
            border: solid 5px;
            border-top-color: transparent !important;
            border-right-color: transparent !important;
            border-left-color: transparent !important;
            top: -5px;
        }</style>
    <style>
        .box{
            box-shadow: 0 2px 3px 0 rgba(81,88,115,.08);
            height: 240px;
            transition: box-shadow .3s ease,transform .3s ease,border .3s ease;
            background-color: #ffffff;
            overflow: hidden;
            position: relative;
            min-height: 1px;

        }

        @media screen and (min-device-width:960px) {
            .box{
                margin-left: 15px;
                margin-right: 15px;
                width: 30%;
            }
        }

        .box-tittle{
            color: #93A1B0;
            font-size: 13.5px;
            letter-spacing: 1px;
            text-transform: uppercase;
            text-align: center;
        }
        .box-content{
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
            padding-left: 32px!important;
            padding-right: 32px!important;
            padding-bottom: 16px!important;
            padding-top: 16px!important;
        }
        .box-username{
            text-decoration: none;
            font-weight: 500!important;
            color: #314351!important;
            font-size: 18px!important;
        }
        .box-desc1{
            color: #556575!important;
            font-size: 14px!important;
        }
        .box-desc2{
            font-size: 14px!important;
            color: #314351!important;
            font-weight: 500!important;
        }
        .o-flexy__item{
            float: left;
        }
        .c-PlaylistCard__background {
            bottom: 0;
            left: 0;
            position: relative;
            right: 0;
            top: 0;

            border-bottom-left-radius: 4px;
            border-bottom-right-radius: 4px;
        }
        .c-PlaylistCard__circle--1 {
            bottom: -220px;
            left: -159px;
        }
        .c-PlaylistCard__circle {
            background-color: currentColor;
            border-radius: 50%;
            height: 200px;
            opacity: .04;
            position: absolute;
            width: 200px;
        }
        .c-PlaylistCard__circle--2 {
            bottom: -50px;
            left: 80px;
        }
        .c-PlaylistCard__circle--3 {
            top: -100px;
            left: 247px;
        }
        .btn{
            border-radius: 100px;
        }
        .postBtn{
            float: right;border-radius: 100px;background-color: #f66e6e;padding: 3px 10px;color: white;
            font-size: 1.3em;

        }
        .postBtn:hover{
            box-shadow: lightgrey 2px 2px 2px;
        }
    </style>
</head>

<body class="" style="background-color: #f2f5f9">


<nav class="navbar navbar-default navbar-fixed-top header">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#header-navbar-collapse" aria-expanded="false">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                <p style="line-height: 50px;color: white;">
                    欢迎访问社团报名系统&nbsp;{{ Session::get('username') }} <span id="usernametext"></span>
                </p>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="header-navbar-collapse">

            <div class="navbar-right btns">
                @if(Session::get('username') != null)

                    <a class="btn btn-default navbar-btn sign-up" id="logout" onclick="logout();">退出登录</a>
                @else
                    <a class="btn btn-default navbar-btn sign-up" data-sign="signin" href="#sign-modal" data-toggle="modal">登录</a>

                @endif

            </div>


        </div>
    </div>
</nav>


<div class="container layout layout-margin-top">


    <div class="">
        <div class="col-md-12 layout-body">


            <div class="content position-relative" style="background-color: #f2f5f9">

                <div class="clearfix"></div>

                <div class="search-result"></div>


                <div id="row" class="row">
                    <h2>已报名社团:
                        @if(Session::get('shetuan') != '0' && Session::get('shetuan') != null)
                            {{Session::get('shetuan')}}
                        @else
                            暂未报名
                        @endif
                    </h2>
                    @foreach ($data as $item)
                        <div class="col-md-4 col-sm-6  course box">
                            <div class="c-PlaylistCard__background" >
                                <div class="c-PlaylistCard__circle c-PlaylistCard__circle--1"></div>
                                <div class="c-PlaylistCard__circle c-PlaylistCard__circle--2"></div>
                                <div class="c-PlaylistCard__circle c-PlaylistCard__circle--3"></div>
                            </div>
                            <div class="box-content">
                                <div class="" style="margin-top: -5px">

                                    <svg t="1559550891730" class="otherOrder" style="" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                         p-id="9844"
                                         width="48" height="48">
                                        <defs>
                                            <style type="text/css"></style>
                                        </defs>
                                        <path class="orderChange"  d="M644.096 999.936c-25.088 0-46.592-16.384-55.808-43.008l-124.416-344.064c-14.848-40.96 6.656-86.016 47.104-100.864l146.944-53.248c8.704-3.072 17.408-4.608 26.624-4.608 33.28 0 62.976 20.992 74.24 52.224l124.416 344.064c7.68 20.992 5.632 42.496-5.632 58.368-10.752 15.36-28.672 24.064-49.664 24.064-3.584 0-7.68-0.512-11.264-1.024l-51.2-7.68h-3.584c-13.312 0-29.696 7.68-35.84 14.336l-34.304 37.888c-13.312 15.36-30.208 23.552-47.616 23.552z"
                                              fill="#A05AF0" p-id="9845"></path>
                                        <path d="M684.544 525.824c-1.024 0-1.536 0-2.56 0.512l-146.944 53.248c-3.584 1.536-5.632 5.632-4.096 9.216l118.784 327.68 23.04-25.6c20.48-23.04 56.32-38.4 89.088-38.4 4.608 0 9.216 0.512 13.824 1.024l34.304 5.12-118.784-327.68c-1.024-3.584-4.096-5.12-6.656-5.12z"
                                              fill="white" p-id="9846"></path>
                                        <path class="orderChange" d="M339.456 1001.984c-19.456 0-36.864-9.728-50.176-27.648l-30.72-41.472c-6.656-8.704-25.088-17.92-36.864-17.92h-1.024l-51.2 3.072h-4.608c-22.528 0-41.984-9.728-52.736-26.624-11.264-17.408-11.776-39.424-1.536-60.928l155.136-331.264c12.8-27.648 40.96-45.568 71.68-45.568 11.264 0 23.04 2.56 33.28 7.168l141.312 66.048c18.944 8.704 33.28 24.576 40.448 44.544 7.168 19.968 6.144 40.96-2.56 60.416L394.24 963.584c-11.264 24.064-31.744 38.4-54.784 38.4z"
                                              fill="#A05AF0" p-id="9847"></path>
                                        <path d="M221.184 843.776c34.304 0 74.24 19.456 94.208 46.592l20.992 27.648 147.968-315.904c1.024-2.048 0.512-4.096 0-5.632-0.512-1.536-1.536-3.072-3.584-4.096l-141.312-66.048c-1.024-0.512-2.048-0.512-3.072-0.512-2.048 0-5.12 1.024-6.656 4.096l-147.968 315.904 34.304-2.048h5.12z"
                                              fill="white" p-id="9848"></path>
                                        <path class="orderChange" d="M459.776 37.888c26.624-21.504 69.632-21.504 96.256 0s75.776 34.816 109.568 29.184c33.792-5.632 71.168 16.384 83.456 48.128s48.128 68.096 79.872 79.872c31.744 12.288 53.76 49.664 48.128 83.456-5.632 33.792 7.68 82.944 29.184 109.568 21.504 26.624 21.504 69.632 0 96.256s-34.816 75.776-29.184 109.568c5.632 33.792-16.384 71.168-48.128 83.456-31.744 12.288-68.096 48.128-79.872 79.872-12.288 31.744-49.664 53.76-83.456 48.128-33.792-5.632-82.944 7.68-109.568 29.184-26.624 21.504-69.632 21.504-96.256 0s-75.776-34.816-109.568-29.184c-33.792 5.632-71.168-16.384-83.456-48.128-12.288-31.744-48.128-68.096-79.872-79.872-31.744-12.288-53.76-49.664-48.128-83.456 5.632-33.792-7.68-82.944-29.184-109.568-21.504-26.624-21.504-69.632 0-96.256s34.816-75.776 29.184-109.568c-5.632-33.792 16.384-71.168 48.128-83.456s68.096-48.128 79.872-79.872 49.664-53.76 83.456-48.128c33.792 5.632 83.456-7.68 109.568-29.184z"
                                              fill="#A05AF0" p-id="9849"></path>
                                        <path d="M193.024 436.224c0 174.08 140.8 314.88 314.88 315.392 174.08 0 314.88-140.8 315.392-314.88 0-174.08-140.8-314.88-314.88-314.88-174.592-0.512-315.392 140.288-315.392 314.368z"
                                              fill="white" p-id="9850"></path>

                                    </svg>


                                </div>

                                <div class="" style="margin-top: 12px!important;padding-bottom: 10px!important;">
                                    <p class="box-username item{{$item['id']}}">{{$item['shetuan']}}</p>
                                </div>
                                <div class="">
                                    <div class="tx-14">
                                        <div class="">
                                            <div class="">
                                                <span class="box-desc1">指导教师</span>
                                                <span class="box-desc2">{{$item['tName']}}</span>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="" style="padding-top: 20px">
                                <span class="course-per-num pull-left" style="font-size: 1.3em">
                                    <i class="box-desc1">可报名人数</i>
                                     @if(Session::get('username')!=null)
                                        {{$item['sum'] - $item['count']}}人
                                    @else
                                         请登录
                                    @endif
                                </span>
                                    @if(Session::get('shetuan') != $item['shetuan'])
                                        @if($item['count'] == $item['sum'])
                                            <span style="cursor: not-allowed;background-color: gray"  class="postBtn"  >人数已满</span>

                                        @else
                                            <button style="cursor: pointer;"   class="postBtn" onclick="postSend('{{$item["shetuan"]}}')">点击报名</button>

                                        @endif
                                    @else
                                        <span style="cursor: not-allowed;background-color: gray"  class="postBtn" >已报名</span>
                                    @endif

                                </div>
                            </div>



                        </div>
                    @endforeach
                    <nav class="pagination-container" style="margin-top: 100px">
                        {{$links}}
                    </nav>
                </div>



            </div>

        </div>

    </div>
</div>

<div class="modal fade" id="sign-modal" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <button type="button" class="close-modal" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            <div class="modal-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="">
                        <a href="#signin-form" id="sign-btn" aria-controls="signin-form" role="tab" data-toggle="tab"
                           aria-expanded="false">登录</a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane" id="signin-form">
                        <form  method="post">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="" style="margin:0;">学号</i>
                                    </div>
                                    <input type="text" id="sno" name="sno" class="form-control" placeholder="请输入学号">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="" style="margin:0;">姓名</i>
                                    </div>
                                    <input type="text" id="username" name="username" class="form-control" placeholder="请输入姓名">
                                </div>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" name="submit" id="doLogin" type="button" value="点击登录">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--<a id="dologin">aegdsdgdgdsfgs</a>--}}
<div class="footer">

    <div class="text-center copyright">
        <span>Copyright @2019-2020 重庆第二师范学院</span>

    </div>
</div>
<div id="errorNote" style="display: none">

</div>


</body>
<script type="text/javascript" src="{{asset("resources/views/app/js/jquery.js")}}"></script>
<script src="{{asset("resources/views/layer/layer.js")}}"></script>

<script src="{{asset("resources/views/app/dest/lib/lib.js?=2016121272249")}}"></script>
<script src="{{asset("resources/views/static/jquery/2.2.4/jquery.min.js")}}"></script>
<script src="{{asset("resources/views/app/js/sweetalert.js")}}"></script>


<script src="{{asset("resources/views/app/dest/course/index.js?=2016121272249")}}"></script>






<script>

    var time_range = function (beginTime, endTime) {
        var strb = beginTime.split (":");
        if (strb.length != 2) {
            return false;
        }

        var stre = endTime.split (":");
        if (stre.length != 2) {
            return false;
        }

        var b = new Date ();
        var e = new Date ();
        var n = new Date ();

        b.setHours (strb[0]);
        b.setMinutes (strb[1]);
        e.setHours (stre[0]);
        e.setMinutes (stre[1]);

        if (n.getTime () - b.getTime () > 0 && n.getTime () - e.getTime () < 0) {
            $("#errorNote").html("");
            $("#errorNote").hide();
        } else {
            $("#errorNote").html(" <div class=\"swal-overlay swal-overlay--show-modal\" tabindex=\"-1\">\n" +
                "        <div class=\"swal-modal\" role=\"dialog\" aria-modal=\"true\"><div class=\"swal-icon swal-icon--error\">\n" +
                "                <div class=\"swal-icon--error__x-mark\">\n" +
                "                    <span class=\"swal-icon--error__line swal-icon--error__line--left\"></span>\n" +
                "                    <span class=\"swal-icon--error__line swal-icon--error__line--right\"></span>\n" +
                "                </div>\n" +
                "            </div>\n" +
                "            <div class=\"swal-title\" style= \"margin-left: 20px;\">未开启报名！</div>\n" +
                "            <div class=\"swal-text\" style=\"   \">报名开始时间为13:00</div>\n" +
                "            <div></div>\n" +
                "            <button style=\"margin-bottom: 20px;margin-top: 20px;\" class=\"btn btn-success\" onclick=\"logout()\">退出登录</button>\n" +
                "\n" +
                "        </div>\n" +
                "    </div>");
            $("#errorNote").show();
        }
    }
    @if(Session::get('username')!=null)
     // time_range ("13:00", "24:00");

    @endif
    @if(Session::get('username')!=null and Session::get('status') != 0 and Session::get('status') != 1)
    layer.msg("报名失败,正在更新数据,请等待!",{time:100000,icon:6,shift:6});
    setTimeout(function () {
        jQuery.ajax({
            url:"{{url('getStatus')}}",
            type:'post',
            success:function (res) {
                document.location.reload();
            }
        });
    },2000);
    @endif
    changeColor();
    function postSend(id){


            @if(Session::get('username') == null)
            $("#sign-btn").click();
            layer.msg("请登录系统后进行操作!",{time:1000,icon:6,shift:6});
            @else
            jQuery.ajax({
                url:"{{'loadClass'}}",
                type:"post",
                success:function (res) {
                    var SessionClass = "{{Session::get('class')}}";
                    var pos = true;
                    for (let i = 0; i < res.length; i++) {
                        console.log(res[i]);
                        console.log(SessionClass);
                        if (SessionClass == res[i]) {
                            pos = false;
                            @if(Session::get('shetuan') != '0')
                            layer.confirm('确认报名 ['+id +'] 吗？<br><br><i>注意:</i>将清除上一次报名信息！', {
                                    btn: ['确认','取消']
                                },
                                    @else
                                    layer.confirm('确认报名 ['+id +'] 吗？', {
                                            btn: ['确认','取消']
                                        },
                                            @endif

                                            function(){
                                                var loaderIndex = layer.msg('正在报名中,请稍候...',{time:1000000,icon:16});
                                                removeClick();
                                                jQuery.ajax({
                                                    url:"{{url('doSend')}}",
                                                    type: 'post',
                                                    data:{'id':id},
                                                    success: function (res) {

                                                        if (res == -1){
                                                            layer.msg("人数已满或系统错误,2秒后自动刷新!",{time:2000,icon:5,shift:6},function () {
                                                                window.location.reload();
                                                            });
                                                        }else{
                                                            function loop(i) {
                                                                i++;
                                                                jQuery.ajax({
                                                                    url:"{{url('getStatus')}}",
                                                                    type:'post',
                                                                    success:function (res) {
                                                                        console.log(res);
                                                                        if(res == -2 || res == -1){
                                                                            layer.msg("人数已满或系统错误,2秒后自动刷新!",{time:2000,icon:5,shift:6},function () {
                                                                                window.location.reload();
                                                                            });
                                                                        }else if (res == 1 ) {
                                                                            layer.msg("报名成功!",{time:1000,icon:6,shift:6});
                                                                            document.location.reload();
                                                                        }

                                                                    }
                                                                });
                                                                if (i<10)
                                                                    setTimeout(function () {
                                                                        loop(i);
                                                                    }, 3000);
                                                            }
                                                            loop(0);

                                                        }

                                                    }
                                                });
                                            }, function(){
                                            layer.closeAll();
                                        });
                        }
                    }
                    if (pos){
                        OKClass = res.join("--");
                        swal ( "当前为下列班级报名时间!" ,  OKClass ,  "error" );
                    }

                }
            });

            @endif

    }
    function changeColor(){
        $('.c-PlaylistCard__background').each(function(){
            var r = Math.ceil(Math.random() * 255);
            var g = Math.ceil(Math.random() * 255);
            var b = Math.ceil(Math.random() * 255);
            var a = Math.ceil(Math.random() * 255);
            $(this).css("color", 'rgb(' + r + ',' + g + ',' + b + ',' + a + ')');
        });

        $('.otherOrder').each(function(){
            var r = Math.ceil(Math.random() * 255);
            var g = Math.ceil(Math.random() * 255);
            var b = Math.ceil(Math.random() * 255);
            var a = Math.ceil(Math.random() * 255);
            $(this).find('.orderChange').css("fill", 'rgb(' + r + ',' + g + ',' + b + ',' + a + ')');
        });

    }

    function removeClick(){
        $('.postBtn').attr('disabled','disabled');
        $('#logout').attr('disabled','disabled');
    }
    function addClick(){
        $('.postBtn').attr('disabled',false);
        $('#logout').attr('disabled',false);
    }

    $("#doLogin").click(function () {
        event.preventDefault();
        var sno = $("#sno").val();
        var username = $("#username").val();
        if(sno.length == 0 || username.length == 0){
            layer.msg("请输入学号和姓名",{time:1000,icon:5,shift:6});
            return 0;
        }
        jQuery.ajax({
            url: "{{url('login/validateUser')}}",
            type: 'post',
            dataType: 'text',
            data: {username: username, sno: sno},
            beforeSend: function () {
                var loaderIndex = layer.msg('正在登录,请稍候...',{time:1000000,icon:16});
            },success: function (res) {
                console.log(res);
                if (res == 1) {
                    layer.closeAll();
                    layer.msg("登录成功!",{time:1000,icon:6,shift:6},function () {
                        $(".close-modal").click();
                        window.location.reload();
                    });

                }else{
                    layer.msg("学号或姓名输入错误!",{time:1000,icon:5,shift:6});

                }

            }
        });
        return 0 ;

    });
    function postAjax(obj){
        event.preventDefault();

        var url = $(obj).attr("href");
        jQuery.ajax({
            url: url,
            type: 'post',
            success: function (res) {
                $("#row").html(res);
                changeColor();


            }
        });

    }
    function logout(){
        layer.confirm('确定退出系统吗？', {
            btn: ['退出','取消'] //按钮
        }, function(){
            jQuery.ajax({
                url:"{{url('login/logout')}}",
                type: 'post',
                success: function (res) {
                    window.location.reload();
                }
            });
        }, function(){
            layer.closeAll();
        });
    }


    var _hmt = _hmt || [];
    (function () {
        var hm = document.createElement("script");
        hm.src = "//hm.baidu.com/hm.js?6eb47a3aeda6ea31fa53985fdfdc78e8";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
    ga('create', 'UA-89338452-1', 'auto');
    ga('send', 'pageview');
</script>


</html>