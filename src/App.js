import React from 'react';
import FaqList from './components/FaqList';
import FaqSection from './components/FaqSection';
const App = () => {
    return (
        <div>
            <h2 className='app-title'>Faq Place App</h2>
            <hr />
            <FaqList />
            <FaqSection />
        </div>
     );
}

export default App;