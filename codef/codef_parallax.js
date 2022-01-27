/*------------------------------------------------------------------------------
Copyright (c) 2011 Ivan PATILLON Aka Totorman

This File is part of the CODEF project. (http://code.google.com/p/codef/)

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

//
// le principe :
//
// faire un canvas de taille >= au canvas destination pour chaque parallax
//
// dessiner ce canvas en decalage de imageLayersPos :
// drawPart dans destination en 0,y de X: imageLayersPos à canvasparralax.width
// drawPart dans destination en imageLayersPos,y de 0 à imageLayersPos-(canvasparralax.width-destination.width)
//
// ----------------------------------------------------------------------------
//
// sample usage
//
// ----------------------------------------------------------------------------
//
// init datas
//
//    var nuages1 = new image('./nuages1.png') ;
//    var nuages2 = new image('./nuages2.png') ;
//    var mont1   = new image('./mont1.png') ;
//    var mont2   = new image('./mont2.png') ;
//    var mont3   = new image('./mont3.png') ;
//
//	  var parallaxData = new Array() ;
//    parallaxData.push( {img:nuages1, y:0,   speed:0.3, dir:-1} ) ;
//    parallaxData.push( {img:nuages2, y:60,  speed:0.8, dir:-1} ) ;
//    parallaxData.push( {img:mont1  , y:100, speed:2,	 dir:-1} ) ;
//    parallaxData.push( {img:mont2  , y:250, speed:3,	 dir:-1} ) ;
//    parallaxData.push( {img:mont3  , y:400, speed:5,	 dir:-1} ) ;
//
//	  var myparallax;
//    myparallax = new parallax();
//    myparallax.init(768,this.parallaxData);
//
// to render in main loop
//
//    myparallax.update();
//	  myparallax.draw(mycanvas);
//
//

function parallax() {
	this.pdata ; // pour extraction des params d'init
    this.nb ;       // nombre de parallax
    this.imageLayers = new Array() ; // les images de chaque parallax
    this.canvasparallax = new Array(); // les canvas parallax
	this.imageLayersPos = new Array() ; // les positions en cours dans chaque parallax

	this.init = function(destwidth, data)
	{
		this.pdata = data;
		this.nb = data.length;

		for(var i=0;i<this.nb; i++)
		{
			this.imageLayers[i] = this.pdata[i].img;
            var tempo = this.imageLayers[i].img.width ;
	
            if (this.pdata[i].dir == 1 ) { this.imageLayersPos[i] = tempo; }
            else { this.imageLayersPos[i] = 0 ; }

            var nbtodraw = Math.ceil(destwidth / tempo) ;
            this.canvasparallax[i] = new canvas(nbtodraw * tempo, this.imageLayers[i].img.height) ;
            for (var j=0; j<nbtodraw; j++) this.imageLayers[i].draw(this.canvasparallax[i],j*tempo,0);
		}
	}

	this.update = function()
	{
		for(var i=0;i<this.nb; i++)
		{
            largeur = this.canvasparallax[i].canvas.width ;
			if (this.pdata[i].dir == 1)
			{
                this.imageLayersPos[i] -= this.pdata[i].speed ;
				if(this.imageLayersPos[i] < 0) this.imageLayersPos[i] += largeur-1;
			}
			else
			{
                this.imageLayersPos[i] += this.pdata[i].speed ;
				if (this.imageLayersPos[i] >= largeur) this.imageLayersPos[i] -= largeur-1;
			}
		}
	}

	this.draw = function(dest)
	{
		for(var i=0;i<this.nb; i++)
		{
            var thiscanvas = this.canvasparallax[i] ;
            var hauteur = thiscanvas.canvas.height;
            var largeur = thiscanvas.canvas.width ;
            var reste = this.imageLayersPos[i] ;

            if (reste > 0) {
                thiscanvas.drawPart(dest,largeur-reste,this.pdata[i].y,0,0,reste,hauteur) ;
                thiscanvas.drawPart(dest,0,this.pdata[i].y,reste,0,largeur-reste,hauteur) ;
            }
		}
	}
}