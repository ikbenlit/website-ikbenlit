// Dev Note: State object holds all user inputs across screens
const state = {
    text: '',            // Raw uploaded text
    fragments: [],       // Selected text snippets
    prompt: '',          // User-defined generation prompt
    postType: '',        // Chosen post type
    tone: '',            // Chosen tone of voice
    generatedContent: '' // Final generated post
};

// Dev Note: Array of screen IDs for navigation control
const screens = ['screen1', 'screen2', 'screen3', 'screen4', 'screen5', 'screen6', 'screen7'];
let currentScreen = 0;

// Dev Note: Function to show/hide screens based on index
function showScreen(index) {
    screens.forEach((id, i) => {
        document.getElementById(id).style.display = i === index ? 'block' : 'none';
    });
    currentScreen = index;
}

// --- Screen 1: Content Upload ---
const textInput = document.getElementById('textInput');
const nextBtn1 = document.getElementById('nextBtn1');
// Dev Note: Enable 'Next' only when text is entered
textInput.addEventListener('input', () => {
    nextBtn1.disabled = !textInput.value.trim();
});
// Dev Note: Move to screen 2 and load text into content div
nextBtn1.addEventListener('click', () => {
    state.text = textInput.value;
    document.getElementById('content').innerText = state.text;
    showScreen(1);
});

// --- Screen 2: Fragment Selection ---
const content = document.getElementById('content');
const addFragmentBtn = document.getElementById('addFragment');
const fragmentsList = document.getElementById('fragments');
const prompt = document.getElementById('prompt');
const nextBtn2 = document.getElementById('nextBtn2');
// Dev Note: Add highlighted text as a fragment to list and state
addFragmentBtn.addEventListener('click', () => {
    const selection = window.getSelection().toString().trim();
    if (selection) {
        state.fragments.push(selection);
        const li = document.createElement('li');
        li.textContent = selection;
        fragmentsList.appendChild(li);
        updateNextBtn2();
    }
});
// Dev Note: Update prompt in state and check conditions
prompt.addEventListener('input', () => {
    state.prompt = prompt.value;
    updateNextBtn2();
});
// Dev Note: Helper to enable/disable 'Next' based on fragments and prompt
function updateNextBtn2() {
    nextBtn2.disabled = state.fragments.length === 0 || !state.prompt.trim();
}
nextBtn2.addEventListener('click', () => showScreen(2));

// --- Screen 3: Post Type Selection ---
const postTypes = document.querySelectorAll('.post-type');
const nextBtn3 = document.getElementById('nextBtn3');
// Dev Note: Toggle selection and store chosen type
postTypes.forEach(btn => {
    btn.addEventListener('click', () => {
        postTypes.forEach(b => b.classList.remove('selected'));
        btn.classList.add('selected');
        state.postType = btn.dataset.type;
        nextBtn3.disabled = false;
    });
});
nextBtn3.addEventListener('click', () => showScreen(3));

// --- Screen 4: Tone of Voice Selection ---
const tones = document.querySelectorAll('.tone');
const nextBtn4 = document.getElementById('nextBtn4');
// Dev Note: Toggle tone selection and enable generation
tones.forEach(btn => {
    btn.addEventListener('click', () => {
        tones.forEach(b => b.classList.remove('selected'));
        btn.classList.add('selected');
        state.tone = btn.dataset.tone;
        nextBtn4.disabled = false;
    });
});
// Dev Note: Generate post and move to edit screen
nextBtn4.addEventListener('click', () => {
    state.generatedContent = generatePost();
    document.getElementById('generatedContent').value = state.generatedContent;
    showScreen(4);
});

// --- Screen 5: Generate and Edit ---
const generatedContent = document.getElementById('generatedContent');
const regenerateBtn = document.getElementById('regenerateBtn');
const nextBtn5 = document.getElementById('nextBtn5');
// Dev Note: Regenerate using same inputs
regenerateBtn.addEventListener('click', () => {
    state.generatedContent = generatePost();
    generatedContent.value = state.generatedContent;
});
// Dev Note: Save edits and move to preview
nextBtn5.addEventListener('click', () => {
    state.generatedContent = generatedContent.value;
    document.getElementById('previewContent').innerText = state.generatedContent;
    showScreen(5);
});

// --- Screen 6: Preview ---
const backBtn6 = document.getElementById('backBtn6');
const nextBtn6 = document.getElementById('nextBtn6');
// Dev Note: Back to edit; forward to export
backBtn6.addEventListener('click', () => showScreen(4));
nextBtn6.addEventListener('click', () => {
    document.getElementById('finalContent').innerText = state.generatedContent;
    showScreen(6);
});

// --- Screen 7: Export ---
const copyBtn = document.getElementById('copyBtn');
const downloadBtn = document.getElementById('downloadBtn');
// Dev Note: Copy final content to clipboard
copyBtn.addEventListener('click', () => {
    navigator.clipboard.writeText(state.generatedContent);
    alert('Copied to clipboard!');
});
// Dev Note: Download content as a .txt file
downloadBtn.addEventListener('click', () => {
    const blob = new Blob([state.generatedContent], { type: 'text/plain' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'post.txt';
    a.click();
    URL.revokeObjectURL(url);
});

// Dev Note: Simple placeholder generation; replace with AI or rules later
function generatePost() {
    return `${state.fragments.join(' ')} - ${state.prompt} (${state.postType} in ${state.tone} style)`;
}