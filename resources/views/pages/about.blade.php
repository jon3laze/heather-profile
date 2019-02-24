@extends('layouts.app')

@section('content')
    <div class="flex justify-center pb-2">
        <img src="{{ asset('/images/headshot.png') }}" class="about-image">
    </div>
    <div class="flex justify-center py-2 text-grey ">
        <div class="w-1/2">
            <h2 class="font-sans py-2">Summary:</h2>
            <p class="font-serif text-sm pl-3">
                I'm a full-stack developer with an emphasis on web technologies. Pursuing inovation and optimization is second nature due to my love for puzzles and problem solving. I'm self-taught and have a passion for learning performing in roles as developer, system administrator and analyst, NOC technician. Instrumental in building systems and procedures for startups and small businesses. Demonstrated ability to acquire technical knowledge and skills rapidly. Excellent in both oral and written communication.
            </p>
            <br />
            <h2 class="font-sans py-2">Skills:</h2>
            <ul class="list-reset font-mono text-sm pl-3 leading-normal">
                <li><span class="font-bold uppercase">Servers -</span> Nginx, Apache</li>
                <li><span class="font-bold uppercase">Languages -</span> C#, .Net, PHP,  Python, Javascript, HTML<sup>5</sup>, CSS<sup>3</sup>, Bash</li>
                <li><span class="font-bold uppercase">Frameworks -</span> Laravel, WordPress, Roots [Trellis, Bedrock, Sage]</li>
                <li><span class="font-bold uppercase">Databases -</span> MSSQL, SSRS, MySQL, MariaDB</li>
                <li><span class="font-bold uppercase">Protocols -</span> SSH, FTP, SNMP, POP3, IMAP, SMTP, NAT, TELNET, DNS</li>
                <li><span class="font-bold uppercase">Utilities -</span> git, phpunit, npm, yarn, composer, vagrant, ansible</li>
            </ul>
            <br />
            <h2 class="font-sans py-2">References:</h2>
            <span  class="font-serif text-center text-sm pl-3">Available upon <a href="/contact" class="no-underline text-blue">request</a>.</span>
        </div>
    </div>
@endsection
