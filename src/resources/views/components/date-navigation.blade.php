 @if(isset($date))
 <div class="date-navigation">
     <a href="{{ route('works.day', ['date' => \Carbon\Carbon::parse($date)->subDay()->format('Y-m-d')]) }}" class="date-nav-button">&#60;</a>
     <span class="current-date">{{ \Carbon\Carbon::parse($date)->format('Y-m-d') }}</span>
     <a href="{{ route('works.day', ['date' => \Carbon\Carbon::parse($date)->addDay()->format('Y-m-d')]) }}" class="date-nav-button">&#62;</a>
 </div>
 @endif