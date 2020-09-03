<section>
    <img class="img-detail-event" src="<?=$detail_event->photo_event ?>"> 	
</section>

<section> 
    <div class="container">
        <div class="tittle-detail-event"> <?= $detail_event->event_name ?> </div>
        <p class="date-detail-event"> <?= date("D, d F Y", strtotime($detail_event->created_at)); ?> </p>
        <div class="desc-detail-event"> <?= $detail_event->description ?> </div>
    </div>
</section>

