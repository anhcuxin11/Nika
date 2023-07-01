<div class="mt-5 footer" style="border-top: 1px solid #D6D6D6">
    <div class="mt-3 pl-3 content-full">
        <a href="#" class="m-auto-0">
            <img width="158" height="37"  src="{{asset('images/nika5.svg')}}" alt="">
        </a>
        <div class="mt-4 footer-content">
            <div class="d-flex justify-content-between footer-flex">
                <div class="c-footer">
                    <div class="footer-title">Feature</div>
                    <div>
                        <a href="{{ route('candidate.job.index' , ['feature_id' => [1]]) }}">English Language Skills</a><br>
                        <a href="{{ route('candidate.job.index' , ['feature_id' => [12]]) }}">Almost no overtime</a><br>
                        <a href="{{ route('candidate.job.index' , ['feature_id' => [3]]) }}">Working remotely</a><br>
                        <a href="{{ route('candidate.job.index' , ['feature_id' => [4]]) }}">Foreign company</a><br>
                        <a href="{{ route('candidate.job.index' , ['feature_id' => [5]]) }}">Domestic company</a>
                    </div>
                </div>
                <div class="c-footer">
                    <div class="footer-title">Country</div>
                    <a href="{{ route('candidate.job.index' , ['location' => 24]) }}">Ha Noi</a><br>
                    <a href="{{ route('candidate.job.index' , ['location' => 15]) }}">Da Nang</a><br>
                    <a href="{{ route('candidate.job.index' , ['location' => 30]) }}">Ho Chi Minh</a><br>
                    <a href="{{ route('candidate.job.index' , ['location' => 28]) }}">Hai Phong</a>
                </div>
                <div class="c-footer">
                    <div class="footer-title">Language</div>
                    <a href="{{ route('candidate.job.index' , ['languages' => 2, 'language_levels' => [0, 1, 2, 3, 4]]) }}">English</a><br>
                    <a href="{{ route('candidate.job.index' , ['languages' => 1, 'language_levels' => [0, 1, 2, 3, 4]]) }}">Vietnamese</a><br>
                    <a href="{{ route('candidate.job.index' , ['languages' => 3, 'language_levels' => [0, 1, 2, 3, 4]]) }}">Japanese</a>
                </div>
            </div>
        </div>
    </div>
    <div class="py-4 mt-1 font-weight-normal content-full">Copyright©Nika Inc.</div>
</div>
