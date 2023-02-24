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
        }) .then(response => response.json())
        .then(data => {
            console.log('Success:', data);
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }
    return <div>
        <FaqForm onSubmit={onSubmitHandler} />
    </div>
}

export default FaqSection;