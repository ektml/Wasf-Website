@extends("layouts.home.homepage")

@section("og-title")
@endsection
@section("og-description")
@endsection
@section("og-image")
@endsection
@section("title")
privacy&policy
@endsection
@section("header")
@endsection
@section("css")

<style>

body {
  font-family: Arial, sans-serif;
  font-size: 16px;
  line-height: 1.5;
  color: #333;
}

/* Headings Styles */
h1, h2, h3, h4, h5, h6 {
  font-family: Georgia, serif;
  font-weight: bold;
  margin-top: 20px;
  margin-bottom: 10px;
  color: #333;
}

h1 {
  font-size: 32px;
}

h2 {
  font-size: 28px;
}

h3 {
  font-size: 24px;
}

/* Link Styles */


/* List Styles */
ul, ol {
  margin-top: 0;
  margin-bottom: 10px;
}

li {
  margin: 5px 0;
}

/* Paragraph Styles */
p {
  margin-top: 0;
  margin-bottom: 10px;
  text-align: justify;
  word-break: keep-all;
  
}

/* Container Styles */




/* Table Styles */
table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
}

</style>
@endsection

@section("content")

@auth
<a class="addrequesticon" href="{{route('user.requestpublic')}}">
    <i class="fa-solid fa-plus"></i>
</a>  
@else
<a class="addrequesticon" href="#login2"  data-bs-toggle="modal">
    <i class="fa-solid fa-plus"></i>
</a>
@endauth

<div class="privacy&police">

<div class="container py-3">
    <div class="section-header">
        <h2>privacy & police</h2>

    </div>

    
        <h2>How does Wasf deal with the information you provide to us?</h2>
		<p>Wasf is committed to securing your privacy when you visit our website and communicate with us electronically. This page describes the way in which any personal information you provide to us while you are on our site will be used.</p>

		<h2>Exclusion of Legal Responsibility</h2>
		<p>The user acknowledges that he is solely responsible for the nature of the use he determines for the website, and the management of the website, to the fullest extent permitted by law, disclaims all responsibility for any losses, damages, expenses or expenses incurred by the user or exposed to him or any other party as a result of Use of or inability to use the Website.</p>

		<h2>Website Outages, Omissions and Errors Description</h2>
		<p>The site's administration is doing its best to ensure and maintain the continuity of the website's work without problems, although errors, omissions, interruptions and delays may occur at any time, and in such cases we will expect users to be patient until the service returns to its normal rate.</p>

		<h2>Subscriber Account, Password and Information Security</h2>
		<p>The subscriber chooses a password / password for his account, and he will enter his own postal address to write to him, and the responsibility for protecting this password and not sharing or publishing it is on the subscriber, and in the event of any transactions using this password, the subscriber will bear all the responsibilities resulting from that, without any responsibility on Description site. The subscriber bears full responsibility for all his content, which he uploads and publishes through the site. The subscriber cannot delete his account from the description by any means, nor modify the username of his account, because the account is related to financial matters and the rights of other users that can be referred to at any time.</p>

		<h2>Register on the Site</h2>
		<p>Some parts of the site are open only to registered subscribers after providing some personal information about them. The subscriber agrees when registering with the site that the information provided is complete and accurate, and undertakes that he will not register on the site and will not attempt to enter it by impersonating another subscriber's name and will not use a name that the administration may deem inappropriate or inappropriate, such as phone numbers, and names impersonating famous personalities, Site links, incomprehensible names, and the like.</p>

		<h2>Use and Sharing of Information</h2>
		<p>All information provided by users is treated in strict confidence and is not sold or shared with any unauthorized third party.</p>
		<p>Information use cases:</p>
		<ul>
			<li>Developing the services provided by the website and our company's various services.</li>
			<li>In the event of contracting with a third party to develop the services we provide, after committing not to share any information that is inconsistent with this privacy statement.</li>
			<li>If we are legally bound by a court order to disclose any information.</li>
		</ul>

		<h2>Content Censorship</h2>
		<p>Wassef website management reserves the right to monitor any content entered by the subscriber, without being obligated to do so, so it reserves the right (without obligation) to delete, remove or edit any entered materials that violate the terms and conditions of the site without referring to the user.
            The local, international and foreign copyright laws and international treaties protect all the contents of this site, and by subscribing to it, the subscriber agrees implicitly and explicitly to abide by the copyright notices that appear on its pages.</p>

            <p class="py-4">
                This policy is subject to permanent change and development, with notice to subscribers and visitors, and subscribers to review these policies periodically</p>
    

</div>

</div>
@endsection

@section("js")

@endsection
