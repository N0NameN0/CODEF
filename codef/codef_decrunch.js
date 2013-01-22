/*------------------------------------------------------------------------------
Copyright (c) 2011 Antoine Santo Aka NoNameNo

This File is part of the CODEF project.

More info : http://codef.santo.fr
Demo gallery http://www.wab.com

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
------------------------------------------------------------------------------*/
/*
This file is done by TotorMan... ;)
*/

// Animation library for
// main
// Amiga and Atari, and ... decrunchers

function AmigaDecrunch(DType, MaxBarHeight, StartDecrunchAt, DecrunchMaxVBL) {

        function get_random_color() {
            var letters = '0123456789ABCDEF'.split('');
            var color ='';
            for (var i = 0; i < 6; i++ ) {
                color += letters[Math.round(Math.random() * 15)];
            }
            return '#'+color;
        }

    // Amiga shell window
    this.amigashell = new Image() ;
    // base64 encoded PNG
    this.amigashell.src = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAoAAAAGQCAMAAAAJLSEXAAAABGdBTUEAALGPC/xhBQAAAwBQTFRFAAAA////AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAZ3bsYwAAAQB0Uk5T////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////AFP3ByUAAAAJcEhZcwAADsIAAA7CARUoSoAAAAAadEVYdFNvZnR3YXJlAFBhaW50Lk5FVCB2My41LjEwMPRyoQAACT1JREFUeF7t14t227YWRdHm/z+6Jd6gRNmxo2g30ZyjIcEDyG7MNa5v//l38wO+71FAH84FyLM8P8APktw/cF49/gx/t/LqawHT53MB8jTl1dcCps/npwDb+Ce1r3q/mkveSn/z7e03Y93mt/q+AHmK/ubb22/Gus1v9f3bX8HrUj9U7/XTY2cM+2NfzN2yLupB3kd95+PPbp+1NooxFyDPUd/5+LPbZ62NYszPAR6T/qcd3W99fWirOdwey63deUOjhtLPss/6wcOYC5CnGTWUfpZ91g8exrwFePpMmdetfqLf5rocGc/lsj22xVjxZkYNtZFpn/WDhzEXIE8zaqiNTPusHzyM+Y9/xmM7UfTtdWt7bTEu9Xq1mkveSn/z/Wmzz0sZzZgLkOfob74/bfZ5KaMZ8xXgOFO05zoo92oblWVZjN3zqi3rivdR33l99Tfvfp+3ezHnAuQp6juvr/7m3e/zdi/mvAXYjU/ceDCGk9FI62X4ZC5AnuXD0B7NTwGus/Blj+L5cC5AnuUZAcJrCZCoI8D+fwrh5QRI1Aqw/s9hXf20u/Pnr3D31eq3mN+u3vrwvKqL05c6XIw+9eVPXJ3/+tf4xr/p2xLgydX5r3+Nb/ybvq0ZYL3+8s9t/wJ3X6wP+nfqu/3pwWW5mn3uix94UjlP+SJvQoA7Ab7cCHD/mZXX0Gdr1a/luc3aeizKtK723bHflcd6YDzM+82lWqtifxpf+eqydsvidtZGN+c2Y9QPl+U83zb7zhxe2j/R12vFiQB3Y9QPl+U83zb7zhxe2j/R12vFyUWA63le2m5/nM+nW1tf7C7HYG3P3fpq+qgvirWqtse6LJdyun1k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";
    // Mouse, Cursor, black parts of shell window
    this.amigashelltop = new Image() ;
    // base64 encoded PNG
    this.amigashelltop.src = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAoAAAABhCAYAAABGShAtAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAadEVYdFNvZnR3YXJlAFBhaW50Lk5FVCB2My41LjEwMPRyoQAAAy5JREFUeF7t1tFtGzEURcEtJW43vaSVlJBWFMkAbeHxSmCwgGI+j4CRoWOS3/e4/P51WXEcx7vr5/YFAMCmDEAAgG/m+PPj7fKMAQgA8DrH8Xb9+nf1nWcMQACALySNuxX1nWceDkDDDwDg9c4Mu1UGIADAF/JfB+BgCAIAPFYH26r6zrB67gwDEADghDrYVtV3htVzZ0wDcAy92g1BAIBZHWyr6jvD6rkzDEAAgBPqYFtV3xlWz51x+9y+P9z94/23IQgA8FgdbKvqO8PquTNun9v3h7t/vP82AAEAHquDbVV9Z1g9d0aM98bQMwQBAGZ1sK2q7wyr586I8d4YeAYgAMCsDrZV9Z1h9dwZMSZj6BmCAACf6mBbVd95pRiTMfAMQACAT2ncrajvvFKMz4yhNwbg+F3PAQB8B2ncrajvvFKMz4zBZwACANxm0DzuVtR3XinGFYYfAMCeYlxhAAIA7ClGAAD6ihEAgL5iBACgrxgBAOgrRgAA+ooRAIC+YgQAoK8YAQDoK0YAAPqKEQCAvmIEAKCvGAEA6CtGAAD6ihEAgL5iBACgrxgBAOgrRgAA+ooRAIC+YgQAoK8YAQDoK0YAAPqKEQCAvmIEAKCvGAEA6CtGAAD6ihEAgL5iBACgrxgBAOgrRgAA+ooRAIC+YgQAoK8YAQDoK0YAAPqKEQCAvmIEAKCvGAEA6CtGAAD6ihEAgL5iBACgrxgBAOgrRgAA+ooRAIC+YgQAoK8YAQDoK0YAAPqKEQCAvmIEAKCvGAEA6CtGAAD6ihEAgL5iBACgrxgBAOgrRgAA+ooRAIC+YgQAoK8YAQDoK0YAAPqKEQCAvub48/pnRb0HAMAW5pjGXlLvAQCwhTmmsZfUewAAbGGOaewl9R4AAFuYYxp7Sb0HAMAW5pjGXlLvAQCwhTmmsZfUewAAbGGOaewl9R4AAFuYYxp7Sb0HAMAW5pjGXlLvAQCwhTmmsZfUewAAbGGOaewl9R4AAFuYYxp7Sb0HAMAW5pjGXlLvAQCwhTmmsZfUewAAbGGOaewl9R4AAFuYYxp7Sb0HAMAW5pjGXlLvAQCwhRgBAOjqcvwF2cEL76GgH5kAAAAASUVORK5CYII=";

    // Total time for the decrunch effect
    this.DecrunchMaxVBL=DecrunchMaxVBL;
    // Current decrunch vbl counter
    this.DecrunchVBLs=0;
    // Before that point, only shell window, after that point, decrunch visible
    this.StartDecrunchAt=StartDecrunchAt;

    // Decrunch types
    this.NoAmigaShell=0 ;    // bars are full screen
    this.AmigaShellBlink=1 ; // bars are on the Amiga Shell white lines
    this.AmigaShellOver=2 ;  // bars are behind the Amiga Shell white lines
    this.AmigaShellOverPalette=3 ; // bars are behind the Amiga Shell and uses a custom Palette
    this.NoAmigaShellPalette=4 ; // bars are full screen and uses a custom Palette

    // user choice decrunch type
    this.DType = DType ;
    this.palette = new Array() ;

    // base siez of decruch bar
    this.MaxBarHeight = MaxBarHeight ;

    // working canvas
    this.mycanvas_temp = new canvas(720,512)

    // = 1 when all is done
    this.finished = 0 ;

    this.doDecrunch=function(dest) {

        // working canvas sizes
        var W = this.mycanvas_temp.contex.canvas.width ;
        var H = this.mycanvas_temp.contex.canvas.height ;
        // images sizes
        var w1 = this.amigashell.width;
        var h1 = this.amigashell.height;
        var w2 = this.amigashelltop.width;
        var h2 = this.amigashelltop.height;
        // Before decrunch we only draw the Amiga shell window
        if (this.DecrunchVBLs<this.StartDecrunchAt) {
            this.mycanvas_temp.contex.drawImage(this.amigashell,40,16,w1,h1) ;
            this.mycanvas_temp.contex.drawImage(this.amigashelltop,40,16,w2,h2);
        } else {
            // We will parse y
            var y=0 ;
            // While not parsed all height of working canvas
            while (y<=H) {
                // calculate color bar height
                var barh = (1+Math.random())*this.MaxBarHeight ;
                // draws the bar
                var mycolor ;
                if ( ((this.DType==this.AmigaShellOverPalette) || (this.DType==this.NoAmigaShellPalette)) && (this.palette.length >0) ) {
                    mycolor = this.palette[Math.round(Math.random()*this.palette.length)];
                } else {
                    mycolor = get_random_color() ;
                }
                this.mycanvas_temp.contex.fillStyle = mycolor ;
                this.mycanvas_temp.contex.fillRect(0,y,W,barh) ;
                // next bar
                y += barh;
            }

            // if Amiga shell window is the only thing that must blink
            if (this.DType==this.AmigaShellBlink) {
                // set destination-in canvas mode
                this.mycanvas_temp.contex.globalCompositeOperation='destination-in';
                // draw the Amiga shell window
                this.mycanvas_temp.contex.drawImage(this.amigashell,40,16,w1,h1) ;
                // back to normal mode
                this.mycanvas_temp.contex.globalCompositeOperation='source-over';
                // draw front things (mouse, cursor, ...)
                this.mycanvas_temp.contex.drawImage(this.amigashelltop,40,16,w2,h2);
            }
            // if bars must appear behind the amiga shell window
            if ( (this.DType==this.AmigaShellOver) || (this.DType==this.AmigaShellOverPalette) ) {
                // draw the images over the bars
                this.mycanvas_temp.contex.drawImage(this.amigashell,40,16,w1,h1) ;
                this.mycanvas_temp.contex.drawImage(this.amigashelltop,40,16,w2,h2);
            }
        }
        // put destination canvas into no AA mode
        dest.contex.ImageSmoothingEnabled=false;
        dest.contex.webkitImageSmoothingEnabled=false;
        dest.contex.mozImageSmoothingEnabled=false;
        dest.contex.oImageSmoothingEnabled=false;

        // the famous Amiga background blue color
        dest.fill('#0055AD');

        // calculate the destination scale
        var scx = dest.contex.canvas.width/W  ;
        var scy = dest.contex.canvas.height/H  ;

        // draw that decrunch
        this.mycanvas_temp.draw(dest,0,0,1,0,scx,scy);

        // next frame please
        this.DecrunchVBLs++;

        // are we finished ?
        if (this.DecrunchVBLs >= this.DecrunchMaxVBL) { this.finished = 1 ; }
    }

    return this ;
}

function AtariDecrunch(DType, MaxBarHeight, StartDecrunchAt, DecrunchMaxVBL) {

    // Automation logo
    this.automation = new Image() ;
    // base64 encoded PNG
    this.automation.src = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAWwAAAAOAQMAAAAxGrQfAAAABlBMVEUAAAAAAAClZ7nPAAAAAXRSTlMAQObYZgAAAKBJREFUKM+d0kEKxCAMBdAPPYAXGvDqgdnOYT64LWT+j7XQpd0YG58YbdBAJvs32KAYPUggo8GzZAYkusZUHpvcSW0ZQ6lWm09OQI4gWF8ej9jnnppnxVnazBKJxTXRmgp7yX8PnmF+Ks6rupDDj7DJ8+IhNvnw8c5XMaN4Q10Tu5w3X8VUtuJ6yB6fufKCdzE3gflqAl4/Ksu4Paopdvkf8tdqMpbdgqgAAAAASUVORK5CYII=";
    // the famous bee mouse cursor
    this.bee = new Image() ;
    // base64 encoded PNG
    this.bee.src = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAkElEQVRYw+2WSwrAMAhEtfT+V7abblvHH3WgQhaBkODLjCrih91rJA75OM6BOz1auoqADmauzjml08BThlahuoKANelCQYI8LvDIpFRP7QLUDeierxKidSB0N5ULsn/++tZKAlH/l95cRSDaE1J/TjETdmUOzYaUE1HrvEBBwKt4aE+w9RpAVa3FzrqrEv5xAY+XJkrEQi77AAAAAElFTkSuQmCC";

    // Total time for the decrunch effect
    this.DecrunchMaxVBL=DecrunchMaxVBL;
    // Current decrunch vbl counter
    this.DecrunchVBLs=0;
    // Before that point, only shell window, after that point, decrunch visible
    this.StartDecrunchAt=StartDecrunchAt;

    // Decrunch types
    this.AtariAutomation=0 ;    // Automation Packer v2.3r
    this.AtariPalette=1 ;       // user gives its own palette

    this.palette = new Array();

    // user choice decrunch type
    this.DType = DType ;

    // base size of decruch bar
    this.MaxBarHeight = MaxBarHeight ;

    // working canvas
    this.mycanvas_temp = new canvas(640,480)

    // = 1 when all is done
    this.finished = 0 ;


    this.doDecrunch=function(dest) {

        // working canvas sizes
        var W = this.mycanvas_temp.contex.canvas.width ;
        var H = this.mycanvas_temp.contex.canvas.height ;

        // We will parse y
        var y=0 ;

        // if Atari Automation Packer is selected
        if ((this.DType==this.AtariAutomation) || (this.DType==this.AtariPalette) ){
            // images sizes
            var w1 = this.automation.width;
            var h1 = this.automation.height;
            var w2 = this.bee.width;
            var h2 = this.bee.height;

            if ( (this.DType==this.AtariAutomation) || (this.palette.length==0)) { this.palette = Array('#a0b000','#a0a000','#a02010','#a02090','#a0c030','#a0d0a0','#a04000','#a080a0','#a08000','#a000f0','#a0d060','#a0a0a0'); }

            var tmp1=10+Math.round(Math.random()*this.MaxBarHeight);
            // While not parsed all height of working canvas
            while (y<=H) {
                // calculate color bar height
                var barh=Math.round(Math.random()*tmp1);
                var col = Math.round(Math.random()*12);
                // draws the bar
                this.mycanvas_temp.contex.fillStyle = this.palette[col] ;
                this.mycanvas_temp.contex.fillRect(0,y,W,barh) ;
                // next bar
                y += barh;
            }
            // draw the images over the bars
            this.mycanvas_temp.contex.drawImage(this.automation,320-w1/2,7,w1,h1) ;
            this.mycanvas_temp.contex.drawImage(this.bee,320,50,w2,h2);
        }

        // put destination canvas into no AA mode
        dest.contex.ImageSmoothingEnabled=false;
        dest.contex.webkitImageSmoothingEnabled=false;
        dest.contex.mozImageSmoothingEnabled=false;
        dest.contex.oImageSmoothingEnabled=false;

        // calculate the destination scale
        var scx = dest.contex.canvas.width/W  ;
        var scy = dest.contex.canvas.height/H  ;

        // draw that decrunch
        this.mycanvas_temp.draw(dest,0,0,1,0,scx,scy);

        // next frame please
        this.DecrunchVBLs++;

        // are we finished ?
        if (this.DecrunchVBLs >= this.DecrunchMaxVBL) { this.finished = 1 ; }
    }

    return this ;
}