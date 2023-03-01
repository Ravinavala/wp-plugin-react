import React, { useState, useEffect } from 'react';
import classes from "./FaqList.module.css"
    const FaqList = () => {
    const [faqList, setFaqList] = useState([]);
    const siteUrl = window.location.origin;
    useEffect(() => {
        fetch(siteUrl+ '/wp-json/faqplugin/v1/getfaq').then((response) => {
            return response.json();
        }).then((data) => {
            console.log(data)
            setFaqList(data);
        }
        )
    }, []);

    return (
        <div className={classes.faq_main}>
            <h2>Frequently Asked Questions</h2>
            {faqList.map((faqItem) =>
                <div key={faqItem.id} className={classes.faq_item}>
                    <div className={classes.faq_question}>{faqItem.question}</div>
                    <div className={classes.faq_answer}>{faqItem.answer}</div>
                </div>
            )}
        </div>
        );
}

export default FaqList;