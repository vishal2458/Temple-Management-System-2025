@extends('layouts.main')

@section('title', 'Contacts Details')

@section('main-content')

<section class="section">
    <div class="section-header">
      <h1>Inquiry Detail</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item">Inquiries</div>
        <div class="breadcrumb-item">Details</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">{{ $contact['created_at']->format('d-m-Y') }}</h2>

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="tickets">
                <div class="ticket-content">
                  <div class="ticket-header">
                    <div class="ticket-sender-picture img-shadow">
                      <img src="{{ asset('assets/img/avatar/avatar-5.png') }}" alt="image">
                    </div>
                    <div class="ticket-detail">
                      <div class="ticket-title">
                        <h4>{{ $contact['subject'] }}</h4>
                      </div>
                      <div class="ticket-info">
                        <div class="font-weight-600">{{ $contact['name'] }}</div>
                        <div class="bullet"></div>
                        <div class="text-primary font-weight-600">{{ $contact['email'] }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="ticket-description">
                    <p>{{ $contact['message'] }}</p>


                    <button class="btn btn-primary btn-lg"  onclick="window.location.href='mailto:{{ $contact->email }}';">
                        Replay Mail
                    </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
