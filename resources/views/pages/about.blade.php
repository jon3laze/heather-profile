@extends('layouts.app')

@section('content')
    <div class="flex justify-center pb-2">
        <img src="{{ asset('/images/headshot.png') }}" class="about-image">
    </div>
    <div class="flex justify-center px-4 py-2 text-grey font-serif text-sm">
        <div class="w-1/2 post-body">
            <p class="text-justify">I'm a full-stack developer with an emphasis on web technologies. Pursuing inovation and optimization is second nature due to my love for puzzles and problem solving. I'm self-taught and have a passion for learning. As developer, system administrator and analyst, NOC technician, I have gained vast experience in troubleshooting. I have been instrumental in building systems and procedures for startups and small businesses. Demonstrated ability to acquire technical knowledge and skills rapidly. Excellent in both oral and written communication.</p>
        </div>
    </div>
    <div class="flex justify-center px-4 py-2 text-grey font-serif text-sm">
        <div class="w-1/2">
            <ul class="list-reset leading-normal">
                <li><span class="font-bold uppercase">Servers -</span> Nginx, Apache</li>
                <li><span class="font-bold uppercase">Languages -</span> C#, .Net, PHP,  Python, Javascript, HTML<sup>5</sup>, CSS<sup>3</sup>, Bash</li>
                <li><span class="font-bold uppercase">Frameworks -</span> Laravel, WordPress, Roots [Trellis, Bedrock, Sage]</li>
                <li><span class="font-bold uppercase">Databases -</span> MSSQL, SSRS, MySQL, MariaDB</li>
                <li><span class="font-bold uppercase">Protocols -</span> SSH, FTP, SNMP, POP3, IMAP, SMTP, NAT, TELNET, DNS</li>
                <li><span class="font-bold uppercase">Utilities -</span> git, phpunit, npm, yarn, composer, vagrant, ansible</li>
            </ul>
        </div>
    </div>
    <div class="flex justify-center px-4 py-2 text-grey font-serif text-sm">
        <div class="w-1/2">
            <span  class="text-center">
                References available upon <a href="/contact" class="naked-link">request</a>.
            </span>
        </div>
    </div>
@endsection
