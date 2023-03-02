import react from "react";
import FaqForm from "./FaqForm";

const FaqSection = () => {
    const onSubmitHandler = (faqData) => {
        // Send the FAQ data to the custom REST endpoint
        const isLocal = window.location.origin.includes('localhost');
        const siteUrl = isLocal ? window.location.origin + window.location.pathname.substring(0, window.location.pathname.indexOf('/', 1)): window.location.origin;
        fetch(siteUrl + '/wp-json/faqplugin/v1/faq', {
          method: 'POST',
          body: JSON.stringify(faqData),
          headers: {
            'Content-Type': 'application/json'
          }
        }) .then(response => response.json())
        .then(data => {
            console.log('Success:', data);
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }
    return <div className="faq_form_main">
        <FaqForm onSubmit={onSubmitHandler} />
    </div>
}

export default FaqSection;