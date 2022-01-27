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
// Tiles of a canvas or image
//
// very FASTER than drawTile from original codef_core.js
//
// principle : creates a canvas with each tile, resulting only a canvas.draw when a drawTile is called
//
// from original initTile only 1 more parameter and 1 variable declaration is needed
//
// ----------------------------------------------------------------------------
//
// sample usage
//
// ----------------------------------------------------------------------------
//
// init datas
//
// var font1 = new image("./font1.png") ;
// var font1tile = new codef_Tile() ;
// font1tile.initTile(font1, 32, 32, 32) ;
//
// var cvs1 = new canvas(640,480) ;
// var cvs1tile = new codef_Tile() ;
// cvs1tile.initTile(cvs1, 32, 32, 0) ;
//
// to render in main loop
//
// font1tile.print(mycanvas,"BONJOUR",100,100) ;
// cvs1.drawTile(mycanvas,12,200,100) ;
//

function codef_Tile(){
	this.tilew;
	this.tileh;
    this.tilestart=0;
    this.nbTiles=0;
    this.nbTilesw;
    this.nbTilesh;
    this.Tiles = new Array() ;

	function getObjectClass(obj){
	   if (typeof obj != "object" || obj === null) return false;
	   else return /(\w+)\(/.exec(obj.constructor.toString())[1];}

    // init with source, tilewidth, tileheight
	this.initTile = function(src,w,h,tilestart){
		this.tilew = w ;
		this.tileh = h ;
		if (getObjectClass(src) == "canvas") {
			var srcw = src.width ;
			var srch = src.height ;
		}
		
		if (getObjectClass(src) == "image") {
			var srcw = src.img.width ;
			var srch = src.img.height ;
		}

        this.nbTiles = 0 ;
        this.nbTilesw = Math.ceil( srcw / w) ;
        this.nbTilesh = Math.ceil( srch / h) ;
        for (var j=0; j<this.nbTilesh; j++ ) {
            for (var i=0; i<this.nbTilesw; i++) {
                this.Tiles[this.nbTiles] = new canvas(w,h) ;
                this.Tiles[this.nbTiles].clear() ;
                var tempo1 = w ;
                if ( (w*i+tempo1) > srcw) tempo1 = srcw - (w*i) ;
                var tempo2 = h ;
                if ( (h*j+tempo2) > srch) tempo2 = srch -(h*j) ;
                src.drawPart(this.Tiles[this.nbTiles++],0,0,i*w,j*h,tempo1,tempo2) ;
            }
        }

		if(typeof(tilestart)!='undefined')
			this.tilestart=tilestart;
	}

    this.setmidhandle = function() {
        for (var i=0; i<this.nbTiles; i++) this.Tiles[i].setmidhandle() ;
    }

    this.sethandle = function(x,y) {
        for (var i=0; i<this.nbTiles; i++) this.Tiles[i].sethandle(x,y) ;
    }

    this.drawTile = function(dest,n,x,y,alpha,angle,zoomx,zoomy) {
        if (n<this.nbTiles) {
            this.Tiles[n].draw(dest,x,y,alpha,angle,zoomx,zoomy) ;
        }
    }

    this.print=function(dst, str, x, y, alpha, rot, w, h){
		for(var i=0; i<str.length; i++){
			if(typeof(w)!='undefined')
				this.drawTile(dst, str[i].charCodeAt(0)-this.tilestart,x+i*this.tilew*w,y,alpha,rot,w,h);
			else
				this.drawTile(dst, str[i].charCodeAt(0)-this.tilestart,x+i*this.tilew,y,alpha,rot,w,h);
		}
	}

    return this ;
}

