import react from "react";
import FaqForm from "./FaqForm";

const FaqSection = () => {
    const onSubmitHandler = (faqData) => {
        // Send the FAQ data to the custom REST endpoint
        fetch('/litch_venture/wp-json/faqplugin/v1/faq', {
          method: 'POST',
          body: JSON.stringify(faqData),
          headers: {
            'Content-Type': 'application/json'
          }
        })
        .then(response => response.json())
        .then(data => {
            // Save the FAQ data in the WordPress option table
            const faqs = JSON.parse(localStorage.getItem('faqs')) || [];
            const newFaqs = [...faqs, data];
            localStorage.setItem('faqs', JSON.stringify(newFaqs));
        });
    }
    return <div>
        <FaqForm onSubmit={onSubmitHandler} />
    </div>
}

export default FaqSection;