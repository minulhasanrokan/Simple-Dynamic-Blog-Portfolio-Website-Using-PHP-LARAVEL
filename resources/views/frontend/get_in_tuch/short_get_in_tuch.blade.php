<div class="widget">
    <h5 class="title">Get in Touch</h5>
    <form autocomplete="off" action="{{route('frontend.send.message')}}" method="post" class="sidebar__contact">
        @csrf
        <input type="text" id="name" name="name" placeholder="Enter name*" required>
        @error('name')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        <input type="hidden" id="type" name="type" value="0" required>
        <input type="text" id="title" name="title" placeholder="Enter Subject*" required>
        @error('title')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        <input type="text" id="mobile" name="mobile" placeholder="Enter your Mobile*" required>
        @error('mobile')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        <input type="email" id="email" name="email" placeholder="Enter your mail*" required>
        @error('email')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        <textarea name="message" id="message" placeholder="Massage*" required></textarea>
        @error('message')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        <button style="width:100%" type="submit" class="btn">send massage</button>
    </form>
</div>