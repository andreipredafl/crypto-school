# A/B Test Plan

## Identified case

Looking at our learning platform stats, I noticed users often abandon videos in the final 30 seconds when our CTA appears. This is killing our conversion rates

After checking out some successful online courses (like the trading course example in the image), I saw they use high-contrast buttons with urgent messaging and countdown timers that create FOMO (fear of missing out). The combination of a more compelling headline, countdown timer, and stronger CTA button seems to work much better than our current minimalist approach

## A/B test hypothesis

**Hypothesis**: Switching from our basic blue button to an eye-catching orange/yellow one with more urgent text AND adding a countdown timer will boost conversion rates by at least 25%. The combination of bigger size, better color contrast, compelling text, and time-limited offer creates a much stronger psychological trigger for users to take immediate action

## Test description

I'll test two CTA button versions:

**Version A (control)**: Our current blue "Upgrade now" button with basic messaging

**Version B (test)**: A bigger orange/yellow button with "BECOME EXPERT NOW ⏳" text plus a countdown timer to create urgency

### Visual design:

Based on my initial mockups, I've created two button variants as seen in our prototype:

![CTA Buttons A/B test design](/docs/cta-buttons-example-figma.png)

I've included a reference image in the `/docs` folder and created a Figma design for the team to review: [Figma Prototype](https://www.figma.com/design/dGEMi55d8HXVjYneAIhfPl/Crypto-School)

The main differences are:

- **Version A**: Standard blue rectangular button with simple text in a smaller popup
- **Version B**: Attention-grabbing orange/yellow button in a larger popup that includes:
    - All-caps text with a timer emoji
    - An actual countdown timer showing minutes and seconds
    - More compelling headline ("Unlock The Next Chapter In Your Life 🚀")
    - More urgent subtext ("Today is you day to begin changing your life")

Everything else in the video player and popup will stay exactly the same - I'm only testing the button differences.

## Implementation plan

### Step 1: Setup

- I'll use Laravel Pennant for the A/B testing since it's built for Laravel
- Set up a feature flag for the button variants
- Configure a 50/50 split between users seeing version A or B

### Step 2: Implementation

- Create both popup variants in the video player component (simple vs. enhanced with timer)
- Use Pennant's API to determine which version to show each user
- Implement the countdown timer functionality for Version B
- Make sure users consistently see the same variant across sessions

### Step 3: Tracking

- Use Pennant's event tracking to record which variant users see
- Track when the popup appears and when users click the button
- Make sure all interaction data is tied to the correct test group

### Step 4: Analysis

- Run the test for at least 2 weeks to get solid data
- Calculate click-through rates for both versions
- Use statistical methods to verify if any difference is significant

### Step 5: Implementation

- If version B performs better, make it the standard
- Document the improvements
- Plan my next test based on what I learned

## Tools and methods

- **A/B Testing Framework**: Laravel Pennant
- **Analytics**: Google Analytics, HotJar to track user behavior
- **Statistical Analysis**: Custom reports built with Laravel and Inertia
- **Monitoring**: Real-time dashboard using Inertia.js
- **Success Metrics**:
    - Button click rate
    - Premium subscription conversion rate
    - Time spent on platform after clicking
