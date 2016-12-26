<?php
/**
 *	An example of how to use Timers
 *
 *	
 *	@see http://us.php.net/manual/en/control-structures.declare.php#control-structures.declare.ticks
 *
 *	@author Sam Shull <sam.shull@jhspecialty.com>
 *	@version 1.0
 *
 *	07/19/2009
 *	@copyright Copyright (c) 2009 Sam Shull <sam.shull@jhspeicalty.com>
 *	@license <http://www.opensource.org/licenses/mit-license.html>
 *
 *	Permission is hereby granted, free of charge, to any person obtaining a copy
 *	of this software and associated documentation files (the "Software"), to deal
 *	in the Software without restriction, including without limitation the rights
 *	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *	copies of the Software, and to permit persons to whom the Software is
 *	furnished to do so, subject to the following conditions:
 *	
 *	The above copyright notice and this permission notice shall be included in
 *	all copies or substantial portions of the Software.
 *	
 *	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 *	THE SOFTWARE.
 *	
 *
 *	Changes - 
 *
 */

//tick function calls will continue on this page because
//declare(ticks=N) was called on the page that
//this page is included by

print "\nTimers_test3.php";

$end = time() + 1;

while (time() < $end)
{

}

?>