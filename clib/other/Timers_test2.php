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

/**
 *	************************* IMPORTANT ************************************
 *			Timers will NOT work without this declaration
 *
 *	@see http://us.php.net/manual/en/control-structures.declare.php#control-structures.declare.ticks
 */
declare(ticks=100);

echo "\nSecond Timeout: ", setTimeout('print "\ntimeout";', 1000000);

echo "\nSecond Interval: ", setInterval('print "\nTimers_test2.php";', 100000);

$end = time() + 1;

while (time() < $end)
{

}

include 'Timers_test3.php';

