@extends('partials.layout')

@section('title', 'About')

@section('content')
<div class="prose dark:prose-invert max-w-7xl">
    <h1>About Us</h1>
    
    <p>Autistic Led is an autistic adult peer support group that started in 2018 and covers the South Holland area of Lincolnshire, UK.</p>

    <p>
        We have Thursday in-person groups at Polka Dot Studios (AKA The Umbrella) with the address as follows: 
        <x-nav-link :href="url('https://maps.app.goo.gl/RPYzqLU48ygfdCrs9')" target="_blank">
            {{ __('Westlode Street, Spalding, PE11 2AE') }}
        </x-nav-link>
    </p>

    <p>But that's not where it ends!</p>

    <p>You see, at Autistic Led, it's all about meeting your own communication preferences as much as possible. So we have group chats on Whatsapp and Facebook as well as outdoor meet-ups. 
    We are always thinking about new ways to bring the community closer together, specifically our autistic community but also the wider community through events so check back on the What We Offer page or follow us on Facebook</p>

    <h2>A little bit about me</h2>

    <p>My name is Callum Brazzo and I am an autistic adult with OCD and Tourette's, diagnosed at 21 after my alternative journey through mainstream education. Poetry was and still is my most consistent communication tool and I wouldn't be here without it!</p>

    <p>I hope that people that connect with Autistic Led can find healthy outlets for their own expression as our journeys vary... 6 years on, we are still going strong</p>

    <p>
        Wanna know more?
        <x-nav-link :href="route('contact')">
            {{ __('Contact us') }}
        </x-nav-link>
    </p>

    <p>The journey may vary but it is always Autistic Led.</p>
</div>
@endsection
