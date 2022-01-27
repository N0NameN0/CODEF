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
/*------------------------------------------------------------------------------
Modified by TotorMan 8 May 2016 to manage Fullscreen canvas with same
mouseX mouseY that it was when canvas not fullscreen.
For that use :
RelatMousePosX, RelatMousePosY instead of MousePosX, MousePosY in your code
------------------------------------------------------------------------------*/

function MouseTracker(){
        this.list=new Array();

        this.addMouseTrack = function(cvs,ctxmenu){
			this.list.push(cvs);
			cvs.canvas.MousePosXTmp = -1000000;
			cvs.canvas.MousePosYTmp = -1000000;
			cvs.canvas.MouseButtTmp =  0;
			cvs.MousePosX = -1000000;
			cvs.MousePosY = -1000000;
			cvs.RelatMousePosX = -1000000;
			cvs.RelatMousePosY = -1000000;
			cvs.MouseButt =  0;

			cvs.canvas.addEventListener('mouseout', function(){
				this.MousePosXTmp = -1000000;
				this.MousePosYTmp = -1000000;
				this.MouseButtTmp =  0;
		}, false);

			cvs.canvas.addEventListener('mousemove', function(ev){
					this.MousePosXTmp = ev.offsetX;
					this.MousePosYTmp = ev.offsetY;
			}, false);

			cvs.canvas.addEventListener('mousedown', function(ev){
					this.MouseButtTmp = ev.which;
			}, false);

			cvs.canvas.addEventListener('mouseup', function(ev){
					this.MouseButtTmp = 0;
			}, false);

			if(ctxmenu==false){
			  cvs.canvas.addEventListener('contextmenu', function(e) {
				  if (e.button === 2) {
					e.preventDefault();
					return false;
				  }
			  }, false);
			}
        }

        this.MouseUpdate=function(){
			for(var i=0; i<this.list.length; i++){
					var dest = this.list[i] ;
					var src = dest.canvas ;
					dest.MouseButt      = src.MouseButtTmp;
					dest.MousePosX      = src.MousePosXTmp;
					dest.MousePosY      = src.MousePosYTmp;
					dest.RelatMousePosX = src.MousePosXTmp;
					dest.RelatMousePosY = src.MousePosYTmp;

					// if an element is fullscreen
					var elemId = getFSElemId() ;
					if (elemId) {
						// is it my canvas ?
						if (elemId == src.parentElement.id) {
							// Yes, so updating canvas relative mouse coordinates (integer)
							dest.RelatMousePosX = (dest.RelatMousePosX / src.parentElement.clientWidth  * dest.width ) || 0 ;
							dest.RelatMousePosY = (dest.RelatMousePosY / src.parentElement.clientHeight * dest.height) || 0 ;
						}
					}
			}
        }
}

// Get ID of a possible fullscreen Element in document
// compatible at least Chrome (and Webkit browsers), Firefox, MS Things
function getFSElemId() {
 if (document.fullscreenElement) {
   return document.fullscreenElement.id;
 }
 else if (document.msFullscreenElement) {
   return document.msFullscreenElement.id;
 }
 else if (document.mozFullScreenElement) {
   return document.mozFullScreenElement.id;
 }
 else if (document.webkitFullscreenElement) {
   return document.webkitFullscreenElement.id;
 }
}
