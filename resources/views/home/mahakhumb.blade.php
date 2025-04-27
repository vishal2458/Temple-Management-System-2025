@extends('home.layouts.main')

@section('title', 'Maha Kumbh Mela 2025')

@push('css')
    <style>
        .blog {
            width: 90%;
            margin: 0 auto;
        }
        .blog__content h3 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .blog__content p {
            font-size: 18px;
            line-height: 1.8;
            text-align: justify;
        }
        .blog__thumb img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .highlight-box, .important-dates {
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .highlight-box {
            background-color: #f8f9fa;
            border-left: 5px solid #ff6b6b;
        }
        .important-dates {
            background: #fff5e1;
        }
        .blog__content ul {
            list-style: none;
            padding-left: 0;
        }
        .blog__content ul li {
            margin-bottom: 10px;
            font-size: 18px;
        }
        .blog__content ul li i {
            color: #ff6b6b;
            margin-right: 8px;
        }
        blockquote {
            font-size: 20px;
            font-style: italic;
            margin-top: 20px;
            padding-left: 15px;
            border-left: 5px solid #ff6b6b;
        }
    </style>
@endpush

@section('main-content')

<!-- ================> Blog section start here <================== -->
<div class="blog blog-style2 blog-single padding--top padding--bottom bg-light">
    <div class="container">
        <div class="section__wrapper">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="blog__item">
                                <div class="blog__inner">

                                    <!-- Main Image -->
                                    <div class="blog__thumb">
                                        <img src="{{ asset('assets/Maha.jpg') }}" alt="Maha Kumbh Mela 2025">
                                    </div>

                                    <div class="blog__content">
                                        <h3>🌍 <b>Maha Kumbh Mela 2025: The Largest Spiritual Gathering on Earth</b></h3>
                                        <ul>
                                            <li><i class="far fa-calendar"></i> <b>21 March 2025</b></li>
                                            <li><i class="fas fa-user"></i> <b>Admin</b></li>
                                        </ul>

                                        <p>The <b>Kumbh Mela</b> is one of the <b>largest spiritual congregations in the world</b>, drawing <b>millions of devotees, saints, and spiritual seekers</b>. Held every <b>12 years</b>, it is a once-in-a-lifetime experience for those who seek <b>spiritual cleansing and enlightenment</b>.</p>

                                        <p>In <b>2025, Prayagraj, Uttar Pradesh</b>, will host the <b>Maha Kumbh Mela</b>, offering pilgrims a sacred opportunity to bathe in the <b>holy waters of the Triveni Sangam</b>—the confluence of the <b>Ganga, Yamuna, and mythical Saraswati rivers</b>.</p>

                                        <!-- Additional Image -->
                                        <div class="blog__thumb">
                                            <img src="{{ asset('assets/m2.jpg') }}" alt="Kumbh Mela Snan">
                                        </div>

                                        <div class="highlight-box">
                                            <h3>🔹 <b>Historical Significance</b></h3>
                                            <p>The <b>origins of the Kumbh Mela</b> come from ancient Hindu scriptures. When the <b>Devas (Gods) and Asuras (Demons) churned the ocean (Samudra Manthan)</b>, a few drops of the <b>nectar of immortality (Amrit)</b> fell at four locations:</p>
                                            <ul>
                                                <li>📍 <b>Prayagraj (Allahabad)</b></li>
                                                <li>📍 <b>Haridwar</b></li>
                                                <li>📍 <b>Ujjain</b></li>
                                                <li>📍 <b>Nasik</b></li>
                                            </ul>
                                        </div>

                                        <div class="important-dates">
                                            <h3>🗓️ <b>Important Bathing Dates (Shahi Snan) at Maha Kumbh 2025</b></h3>
                                            <ul>
                                                <li>📅 <b>Makar Sankranti</b> – 14 January 2025</li>
                                                <li>📅 <b>Mauni Amavasya</b> – 29 January 2025</li>
                                                <li>📅 <b>Basant Panchami</b> – 12 February 2025</li>
                                                <li>📅 <b>Maghi Poornima</b> – 26 February 2025</li>
                                                <li>📅 <b>Maha Shivratri</b> – 12 March 2025</li>
                                            </ul>
                                        </div>

                                        <h3>🎭 <b>Major Attractions of Maha Kumbh 2025</b></h3>
                                        <ul>
                                            <li>🚩 <b>Shahi Snan (Royal Bath)</b> by saints and Akharas</li>
                                            <li>🎶 <b>Spiritual discourses, bhajans, and kirtans</b></li>
                                            <li>🎭 <b>Cultural performances showcasing India's heritage</b></li>
                                            <li>🔥 <b>Ancient Vedic rituals and Yagnas</b></li>
                                            <li>🕉️ <b>Mass meditation and prayers</b></li>
                                        </ul>

                                        <blockquote>
                                            "<b>The Kumbh Mela is not just an event, it is a spiritual transformation, a sacred gathering that embodies the essence of faith, devotion, and self-realization.</b>"
                                        </blockquote>

                                        <!-- Additional Image -->
                                        <div class="blog__thumb">
                                            <img src="{{ asset('assets/m3.jpg') }}" alt="Crowd at Kumbh Mela">
                                        </div>

                                        <h3>📌 <b>Interesting Facts About Kumbh Mela</b></h3>
                                        <ul>
                                            <li>✅ <b>Recognized by UNESCO</b> as an <b>Intangible Cultural Heritage of Humanity</b>.</li>
                                            <li>✅ The <b>largest recorded gathering</b> in history was the <b>2013 Maha Kumbh in Prayagraj</b>, with over <b>120 million devotees attending</b>.</li>
                                            <li>✅ The entire city turns into a <b>spiritual metropolis</b> with <b>temporary tents, food stalls, and medical services</b>.</li>
                                        </ul>

                                        <div class="highlight-box">
                                            <h3>🚀 <b>Plan Your Visit to Maha Kumbh 2025</b></h3>
                                            <ul>
                                                <li>✅ <b>Stay updated</b> on key bathing dates.</li>
                                                <li>✅ <b>Book accommodations</b> in advance.</li>
                                                <li>✅ <b>Immerse yourself</b> in the spiritual atmosphere.</li>
                                            </ul>
                                        </div>

                                    </div> <!-- blog__content -->
                                </div> <!-- blog__inner -->
                            </div> <!-- blog__item -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ================> Blog section end here <================== -->

@endsection
