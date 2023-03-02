import React, { useState, useEffect } from 'react';
import classes from "./FaqList.module.css"
        const FaqList = () => {
    const [faqList, setFaqList] = useState([]);
    const isLocal = window.location.origin.includes('localhost');
    const siteUrl = isLocal ? window.location.origin + window.location.pathname.substring(0, window.location.pathname.indexOf('/', 1)) : window.location.origin;
    useEffect(() => {
        fetch(siteUrl + '/wp-json/faqplugin/v1/getfaq').then((response) => {
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
                {faqList.length > 0 ? (
                faqList.map((faqItem) => (
                    <div key={faqItem.id} className={classes.faq_item}>
                        <div className={classes.faq_question}>{faqItem.question}</div>
                        <div className={classes.faq_answer}>{faqItem.answer}</div>
                    </div>
                    ))
                ) : (
                <p>No Faq's found</p>
                )}
            </div>
            );
}

export default FaqList;