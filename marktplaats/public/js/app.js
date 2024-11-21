

// Zorgt ervoor dat je een beschrijving krijgt wanneer je je muis 1.5 sec op een button houdt

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.tooltip-btn').forEach(button => {
        let timer;
        button.addEventListener('mouseenter', () => {
            timer = setTimeout(() => {
                const rect = button.getBoundingClientRect();
                
                
                button.classList.remove('tooltip-top', 'tooltip-bottom', 'tooltip-left', 'tooltip-right');

                
                if (rect.top < window.innerHeight / 2) {
                    button.classList.add('tooltip-bottom');
                } else {
                    button.classList.add('tooltip-top');
                }

                
                if (rect.left < window.innerWidth / 2) {
                    button.classList.add('tooltip-right');
                } else {
                    button.classList.add('tooltip-left');
                }

                button.classList.add('hover-tooltip');
            }, 1500); 
        });
        button.addEventListener('mouseleave', () => {
            clearTimeout(timer);
            button.classList.remove('hover-tooltip', 'tooltip-top', 'tooltip-bottom', 'tooltip-left', 'tooltip-right');
        });
    });
}); // gebruik <button class="tooltip-btn" data-tooltip="This is a description that appears after 2 seconds">Hover me</button> voor tooltip
        
        setTimeout(function() {
            var flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                flashMessage.style.transition = 'opacity 1s ease';
                flashMessage.style.opacity = '0';
                setTimeout(function() {
                    flashMessage.remove();
                }, 1000); 
            }
        }, 2500); 
    
