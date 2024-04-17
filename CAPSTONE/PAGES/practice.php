<!DOCTYPE html>
<html>
<head>
  <title>FullCalendar Example</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.js"></script>
</head>
<body>
<input type="date" id='date'/>
<input type="time" id='starttime'/>
<input type="time" id='endtime'/>
<button>Add</button>
<div class="calendar-container">

	<div class="header">
		<ul class="weekdays">
			<li>Sunday</li>
			<li>Monday</li>
			<li>Tuesday</li>
			<li>Wednesday</li>
			<li>Thuesday</li>
			<li>Friday</li>
			<li>Saturday</li>
		</ul>
		<ul class="daynumbers">
			<li>20</li>
			<li>21</li>
			<li>22</li>
			<li>23</li>
			<li>24</li>
			<li>25</li>
			<li>26</li>
		</ul>
	</div>

	<div class="timeslots-container">
		<ul class="timeslots">
			<li>9<sup>am</sup>
			<li>10<sup>am</sup>
			<li>11<sup>am</sup>
			<li>12<sup>am</sup>
			<li>1<sup>pm</sup>
			<li>2<sup>pm</sup>
			<li>3<sup>pm</sup>
			<li>4<sup>pm</sup>
			<li>5<sup>pm</sup>
		</ul>
	</div>

	<div class="event-container">

		<!-- <div class="slot slot-1">
			<div class="event-status"></div>
			<span>event a</span>
		</div>

		<div class="slot slot-2">
			<div class="event-status"></div>
			<span>event b</span>
		</div>

		<div class="slot slot-3">
			<div class="event-status"></div>
			<span>event c</span>
		</div>

		<div class="slot slot-4">
			<div class="event-status"></div>
			<span>event d</span>
		</div> -->

	</div>
</div>
</body>
</html>
